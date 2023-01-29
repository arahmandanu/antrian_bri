<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MstBank;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bankCode = $request->input('bank_code');
        $unitCode = $request->input('unit_code');
        $dateRange = $request->input('queue_for');
        $sla = $request->input('sla');
        $transactions = [];

        if(isset($bankCode)){
            $transactions = Transaction::when($bankCode, function($query, $bankCode){
                return $query->where('br_code', $bankCode);
            })
                ->when($unitCode, function($query, $unitCode){
                    return $query->where('UnitServe', $unitCode);
                })
                ->when($sla, function($query, $sla){
                    if($sla == 1){
                        // Over SLA
                        return $query->whereNotNull('TOverSLA')->Where('TOverSLA', '<>', '00:00:00');
                    } else {
                        // Not Over SLA
                        return $query->whereNull('TOverSLA')->orWhere('TOverSLA', '=', '00:00:00');
                    }
                })
                ->when($dateRange, function($query, $dateRange){
                    $formatQueueFor = $this->formatDateRangePicker($dateRange);
                    return $query->whereBetween('BaseDt', [$formatQueueFor['from']->startOfDay()->format('Ymd'), $formatQueueFor['to']->endOfDay()->format('Ymd')]);
                })
                ->get();
        }

        session()->flashInput($request->input());
        return view('admin.reports.report_index', [
            'banks' => MstBank::all(),
            'transactions' => $transactions
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
