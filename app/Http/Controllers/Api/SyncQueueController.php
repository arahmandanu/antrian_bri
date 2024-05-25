<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MstBank;
use App\Models\Queue;
use App\Models\UnitCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SyncQueueController extends Controller
{

    public function syncFromLocal(Request $request)
    {
        $response = [];
        $localTime = now();
        $paramsTime = Carbon::parse($request->input('current_time'));
        $baseDt = $request->input('BaseDt');

        $company = MstBank::where('code', '=', $request->input('company_id'))->get()->first();
        $unitCode = UnitCode::where('code', '=', $request->input('UnitServe'))->get()->first();

        if (!($localTime->format('Ymd') ==  $baseDt) || empty($company) || empty($unitCode)) {
            $response['error'] = true;
            $response['message'] = 'Not valid params!';
        } else {
            $numberQueue = substr($request->input('SeqNumber'), 1, 3);
            $queue = [
                'ip' => 'sync',
                'id' => Str::uuid(),
                'queue_for' => $localTime->format('Y-m-d'),
                'number_queue' => $numberQueue,
                'unit_code' => $unitCode->code,
                'unit_code_name' => $unitCode->name,
                'bank_id' => $company->id,
                'bank_code' => $company->code,
                'bank_name' => $company->name,
                'bank_address' => $company->address,
                'OnlineQ' => 'N',
                'call' => 'P',
                'transaction_params_id' => $request->input('code_trx')
            ];

            $a = new Queue($queue);
            if ($a->save()) {
                $response['error'] = false;
                $response['message'] = 'Success sync local to server!';
            } else {
                $response['error'] = true;
                $response['message'] = 'Failed sync local to server!';
            }
        }

        return response()->json($queue, 201);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\Queue  $queue
     * @return \Illuminate\Http\Response
     */
    public function show(Queue $queue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Queue  $queue
     * @return \Illuminate\Http\Response
     */
    public function edit(Queue $queue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Queue  $queue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Queue $queue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Queue  $queue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Queue $queue)
    {
        //
    }
}
