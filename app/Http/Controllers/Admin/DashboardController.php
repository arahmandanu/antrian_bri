<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\MstBank;
use App\Models\Queue;
use App\Models\UnitCode;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasRole('admin')) {
            $date = Carbon::now();
            $weekRange = $this->getDateInWeek($date);
            $totalsByDate = [];
            $labels = [];

            $data = Queue::whereBetween('created_at', [Arr::first($weekRange), Arr::last($weekRange)->copy()->endOfDay()])
                ->orderBy('created_at', 'asc')
                ->get()
                ->groupBy(function ($date) {
                    return Carbon::parse($date->created_at)->format('d');
                });

            foreach ($weekRange as $date) {
                if (isset($data[$date->format('d')])) {
                    array_push($totalsByDate, $data[$date->format('d')]->count());
                } else {
                    array_push($totalsByDate, 0);
                }
                array_push($labels, $date->format('M d Y'));
            }

            return view('admin.dashboard_index', [
                'totalBanks' => MstBank::count(),
                'totalUnitCodes' => UnitCode::count(),
                'totalQueues' => Queue::count(),
                'barDataTotal' => $totalsByDate,
                'labels' => $labels,
            ]);
        } else {
            return view('admin.dashboard_operator');
        }
    }
}
