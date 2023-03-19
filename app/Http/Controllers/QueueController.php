<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QueueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [];
        $data['withData'] = false;
        $findQueue = null;
        if ($request->input('id') !== null) {
            $data['withData'] = true;

            $findQueue = Queue::find($request->input('id'));
            if ($findQueue !== null) {
                $data['found'] = true;
                $result = $this->formatMessage($findQueue);
                $data = array_merge($data, $result);
            } else {
                $data['found'] = false;
                $data['message'] = 'Antrian tidak ditemukan!';
            }
        }

        session()->flashInput($request->input());

        return view('public.queue_index', [
            'data' => $data,
        ]);
    }

    private function formatMessage(Queue $queue)
    {
        $startDate = Carbon::parse($queue->queue_for)->copy()->startOfDay();
        $endDate = Carbon::parse($queue->queue_for)->copy()->endOfDay();

        $doneCalled = Queue::whereBetween('queue_for', [$startDate, $endDate])->where('unit_code', $queue->unit_code)->where('call', 'N')->where('bank_id', $queue->bank_id)->latest()->get();
        if ($doneCalled->count() == 0) {
            $current = Queue::whereBetween('queue_for', [$startDate, $endDate])->where('unit_code', $queue->unit_code)->where('bank_id', $queue->bank_id)->oldest()->first();

            $message = '';
            $currentQueue = "{$current->unit_code}{$current->number_queue}";
        } else {
            $current = $doneCalled->first();
            $currentQueue = "{$current->unit_code}{$current->number_queue}";

            if ($queue->call == 'N') {
                if ($queue->number_queue <= $current->number_queue) {
                    $currentQueue = null;
                    $message = 'Antrian anda sudah di proses';
                }
            } else {
                if ($queue->number_queue - $current->number_queue > 0) {
                    $message = 'Silahkan print nomor antrian anda';
                } elseif ($queue->number_queue - $current->number_queue == 0) {
                    $message = 'Nomor antrian anda sudah dalam proses';
                } else {
                    $message = 'Nomor antrian anda telah hangus, silahkan mengulangi ambil antrian';
                }
            }
        }

        return ['message' => $message, 'currentQueue' => $currentQueue];
    }
}
