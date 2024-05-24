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
        return view('public.show_menu_unit_service');
    }

    public function newBarcode(Request $request, $type)
    {
        $distance = 50;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $coor = null;

        if (isset($latitude) && isset($longitude)) {
            $coor = ['latitude' => $latitude, 'longitude' => $longitude, 'distance' => $distance];
        }

        $nearestBank = MstBank::select('id', 'code', 'name', 'address', 'latitude', 'longitude')
            ->when($coor, function ($query, $coor) {
                $query->distance($coor['latitude'], $coor['longitude'], $coor['distance']);
            })
            ->take(5)
            ->get();

        if ($nearestBank->count() == 0) {
            $nearestBank = MstBank::select('id', 'code', 'name', 'address', 'latitude', 'longitude')
                ->take(5)
                ->get();
        }

        return view('public.create_barcode_new', [
            "nearestBank" => $nearestBank,
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
                ->take(5)
                ->get();

            if ($result->count() == 0) {
                $result = MstBank::select('id', 'code', 'name', 'address', 'latitude', 'longitude')
                    ->when($search, function ($query, $search) {
                        $query
                            ->where('address', 'like', "%$search%")
                            ->orWhere('name', 'like', "%$search%");
                    })
                    ->take(5)
                    ->get();
            }
            $data = $result->toArray();
        }

        return json_encode($data);
    }

    public function generateBarcode(GetBarcodeRequest $request, IpService $ip)
    {
        $barcode = new BarcodeService;

        return redirect()->route('barcode.show', ['queue' => $barcode->generate($request->unit_code, $request->queue_for, $request->bank, now(), $ip->get_client_ip())]);
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
