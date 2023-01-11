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
        return view('public.generate_barcode', [
            'banks' => MstBank::select('id', 'code', 'name', 'address')->take(10)->get()->toArray(),
            'unitCodes' => UnitCode::all(),
        ]);
    }

    public function bank(Request $request)
    {
        $data = [];
        if ($request->ajax()) {
            $search = $request->search;
            if (isset($search)) {
                $data = MstBank::select('id', 'code', 'name', 'address')
                    ->when($search, function ($query, $search) {
                        $query
                            ->where('address', 'like', "%$search%")
                            ->orWhere('name', 'like', "%$search%");
                    })
                    ->take(5)
                    ->get()
                    ->toArray();
            }
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
            'dateQueue' => $queue->queue_for,
            'nameQueue' => "Antrian $queue->created_at",
            'barcode' => $queue->getBarcode(),
        ]);
    }
}
