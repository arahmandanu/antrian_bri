<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetBarcodeRequest;
use App\Models\MstBank;
use App\Models\Queue;
use App\Models\UnitCode;
use App\Services\BarcodeService;
use App\Services\IpService;
use Illuminate\Http\Request;
use Throwable;

class BarcodeController extends Controller
{
    public function index()
    {
        $banks = MstBank::select('id', 'code', 'name', 'address')->orderBy('name', 'desc')->take(10)->get()->toArray();

        return view('public.generate_barcode', [
            'banks' => $banks,
            'unitCodes' => UnitCode::all(),
        ]);
    }

    public function showUnitServiceMenu()
    {
        return view('public.show_menu_unit_service', [
            'unitCodes' => UnitCode::all(),
        ]);
    }

    public function newBarcode(Request $request)
    {
        $distance = 50;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $coor = null;
        $unitCode = $request->input('type') ?? 'A';
        if (isset($latitude) && isset($longitude)) {
            $coor = ['latitude' => $latitude, 'longitude' => $longitude, 'distance' => $distance];
        }

        $nearestBank = MstBank::select('id', 'code', 'name', 'address', 'latitude', 'longitude')
            ->when($coor, function ($query, $coor) {
                $query->distance($coor['latitude'], $coor['longitude'], $coor['distance']);
            })
            ->take(10)
            ->get()
            ->reverse()
            ->values();

        if ($nearestBank->count() == 0) {
            $nearestBank = MstBank::select('id', 'code', 'name', 'address', 'latitude', 'longitude')
                ->take(10)
                ->get()
                ->reverse()
                ->values();
        }

        $unitCodeLocal = UnitCode::where('code', '=', $unitCode)->first();
        if (empty($unitCodeLocal) || empty($unitCodeLocal->transactions)) {
            $transactionParams = [];
        } else {
            $transactionParams = $unitCodeLocal->transactions;
        }

        return view('public.create_barcode_new', [
            "nearestBank" => $nearestBank,
            "unitCode" => $unitCode,
            "transactionParams" => $transactionParams
        ]);
    }

    public function bank(Request $request)
    {
        $data = [];
        if ($request->ajax()) {
            $distance = 1;
            $search = $request->search;
            $latitude = $request->latitude;
            $longitude = $request->longitude;
            $coor = null;

            if (isset($latitude) && isset($longitude)) {
                $coor = ['latitude' => $latitude, 'longitude' => $longitude, 'distance' => $distance];
            }

            $result = MstBank::select('id', 'code', 'name', 'address', 'latitude', 'longitude')
                ->when($search, function ($query, $search) {
                    $query
                        ->where('address', 'like', "%$search%")
                        ->orWhere('name', 'like', "%$search%");
                })
                ->when($coor, function ($query, $coor) {
                    $query->distance($coor['latitude'], $coor['longitude'], $coor['distance']);
                })
                ->take(10)
                ->get();

            if ($result->count() == 0) {
                $result = MstBank::select('id', 'code', 'name', 'address', 'latitude', 'longitude')
                    ->when($search, function ($query, $search) {
                        $query
                            ->where('address', 'like', "%$search%")
                            ->orWhere('name', 'like', "%$search%");
                    })
                    ->take(10)
                    ->get();
            }
            $data = $result->toArray();
        }

        return json_encode($data);
    }

    public function generateBarcode(GetBarcodeRequest $request, IpService $ip)
    {
        $barcode = new BarcodeService;
        return redirect()->route('barcode.show', ['queue' => $barcode->generate($request->unit_code, $request->queue_for, $request->bank, now(), $ip->get_client_ip(), $request->transaction_params_id)]);
    }

    public function showBarcode($queueUuid)
    {
        try {
            $decryptedUuid = decrypt($queueUuid);
        } catch (Throwable $e) {
            flash()->error('Barcode tidak di temukan');

            return redirect()->route('barcode.show_form');
        }

        $queue = Queue::findOrFail($decryptedUuid);

        return view('public.show_barcode', [
            'numberQueue' => $queue->number_queue,
            'unitCode' => $queue->unit_code,
            'dateQueue' => $queue->queue_for,
            'nameQueue' => "Antrian $queue->created_at",
            'barcode' => $queue->getBarcode(),
            'id' => $queue->id,
            'bankCode' => $queue->bank_code,
        ]);
    }
}
