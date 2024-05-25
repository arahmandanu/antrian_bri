<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MstBank;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OverSlaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cs = 0;
        $csOver = 0;
        $teller = 0;
        $tellerOver = 0;
        $online = 0;
        $offline = 0;
        $dateRange = [];

        if ($request->input('month')) {
            $firstMonth = Carbon::create()->month($request->input('month'))->year(Carbon::now()->year);
            $lastMonth = $firstMonth->copy()->endOfMonth();
            $dateRange = [$firstMonth->format('Ymd'), $lastMonth->format('Ymd')];
        }

        $bankCode = $request->input('bank_code');
        if (isset($dateRange) && isset($bankCode)) {
            $transactions = Transaction::when($bankCode, function ($query, $bankCode) {
                return $query->where('br_code', $bankCode);
            })
                ->when($dateRange, function ($query, $dateRange) {
                    return $query->whereBetween('BaseDt', $dateRange);
                })
                ->get();

            foreach ($transactions as $transaction) {
                if ($transaction->OnlineQ == 'Y') {
                    $online++;
                } else {
                    $offline++;
                }

                if ($transaction->UnitServe == 'A') {
                    if (isset($transaction->TOverSLA) && ($transaction->TOverSLA != '00:00:00')) {
                        $tellerOver++;
                    } else {
                        $teller++;
                    }
                } else {
                    if (isset($transaction->TOverSLA) && ($transaction->TOverSLA != '00:00:00')) {
                        $csOver++;
                    } else {
                        $cs++;
                    }
                }
            }
        }

        session()->flashInput($request->input());

        return view('admin.reports.over_sla_index', [
            'month' => 'asd',
            'cs' => $cs,
            'csover' => $csOver,
            'teller' => $teller,
            'tellerover' => $tellerOver,
            'online' => $online,
            'offline' => $offline,
            'banks' => MstBank::all(),
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
