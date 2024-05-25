<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankArea;
use App\Models\BankBranch;
use App\Models\ButtonActor;
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
        $valid = $this->validate($request, [
            'area_code' => ['prohibits:branch_code', 'prohibits:bank_code'],
            'branch_code' => ['prohibits:area_code', 'prohibits:bank_code'],
            'bank_code' => ['prohibits:area_code', 'prohibits:branch_code'],
        ]);

        $area_code = $request->input('area_code');
        $branch_code = $request->input('branch_code');
        $bankCode = $request->input('bank_code');
        $userId = $request->input('UserId');
        $transactions = [];

        if (isset($bankCode) || isset($branch_code) || isset($area_code)) {
            $branchsId = null;
            $areaId = null;
            $unitCode = $request->input('unit_code');
            $dateRange = $request->input('queue_for');
            $sla = $request->input('sla');

            if (isset($branch_code)) {
                $branchsId = MstBank::where('KC_Code', $branch_code)->pluck('code');
            }

            if (isset($area_code)) {
                $areaId = MstBank::where('Area_Code', $area_code)->pluck('code');
            }

            $transactions = Transaction::when($bankCode, function ($query, $bankCode) {
                return $query->where('br_code', $bankCode);
            })
                ->when($branchsId, function ($query, $branchsId) {
                    return $query->wherein('br_code', $branchsId);
                })
                ->when($areaId, function ($query, $areaId) {
                    return $query->wherein('br_code', $areaId);
                })
                ->when($unitCode, function ($query, $unitCode) {
                    return $query->where('UnitServe', $unitCode);
                })
                ->when($sla, function ($query, $sla) {
                    if ($sla == 1) {
                        // Over SLA
                        return $query->whereNotNull('TOverSLA')->Where('TOverSLA', '<>', '00:00:00');
                    } else {
                        // Not Over SLA
                        return $query->where(function ($query) {
                            $query->whereIn('TOverSLA', ['', '00:00:00'])->orWhereNull('TOverSLA');
                        });
                    }
                })
                ->when($dateRange, function ($query, $dateRange) {
                    $formatQueueFor = $this->formatDateRangePicker($dateRange);

                    return $query->whereBetween('BaseDt', [$formatQueueFor['from']->startOfDay()->format('Ymd'), $formatQueueFor['to']->endOfDay()->format('Ymd')]);
                })
                ->when($userId, function ($query, $userId) {
                    return $query->where('UserId', $userId);
                })
                ->get();
        }

        session()->flashInput($request->input());
        $actor = null;
        if ($userId !== null) {
            $actor = ButtonActor::select('code as id', 'name as text')->where('code', $userId)->get()->toArray();
        } else {
            $actor = ButtonActor::select('code as id', 'name as text')->take(5)->get()->toArray();
        }

        return view('admin.reports.report_index', [
            'banks' => MstBank::all(),
            'bankAreas' => BankArea::all(),
            'bankBranches' => BankBranch::all(),
            'transactions' => $transactions,
            'actor' => $actor,
        ]);
    }

    public function branchMap()
    {
        $banks = MstBank::all()->toArray();
        return view('admin.reports.branch_map', [
            "banks" => $banks
        ]);
    }
}
