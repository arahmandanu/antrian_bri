<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Queue;
use App\Models\UnitCode;
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
        $bank = $request->bank;
        $unit_code = $request->unit_code;
        $queue_for = $request->queue_for;
        $created_at = $request->created_at;

        $queues = Queue::when($bank, function ($query, $bank) {
            $query->where('bank_id', $bank);
        })
            ->when($unit_code, function ($query, $unit_code) {
                $query->where('unit_code', $unit_code);
            })
            ->when($queue_for, function ($query, $queue_for) {
                $formatQueueFor = $this->formatDateRangePicker($queue_for);
                $query->whereBetween('queue_for', [$formatQueueFor['from']->format('Y-m-d'), $formatQueueFor['to']->format('Y-m-d')]);
            })
            ->when($created_at, function ($query, $created_at) {
                $formatCreatedAt = $this->formatDateRangePicker($created_at);
                $query->whereBetween('created_at', [$formatCreatedAt['from']->startOfDay(), $formatCreatedAt['to']->endOfDay()]);
            })
            ->latest()
            ->paginate(15);

        $queues->appends($request->all());
        session()->flashInput($request->input());

        return view('admin.queue.index', [
            'queues' => $queues,
            'unitCodes' => UnitCode::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
