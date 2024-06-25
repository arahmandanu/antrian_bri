<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MstBank;
use App\Models\Queue;
use App\Models\Transaction;
use App\Models\UnitCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SyncQueueController extends Controller
{
    public const MAX_QUEUE = 3;

    public function syncReportFromLocal(Request $request)
    {
        $company = MstBank::where('code', '=', $request->input('company_id'))->get()->first();
        if (!empty($company)) {
            $formatedReports = [];
            $reports = $request->input('reports');
            foreach ($reports as $key => $value) {
                $params = [
                    'BaseDt' => $value['BaseDt'],
                    'br_code' => $company->code,
                    'SeqNumber' => $value['SeqNumber'],
                    'TrxDesc' => $value['TrxDesc'],
                    'TimeTicket' => $value['TimeTicket'],
                    'TimeCall' => $value['TimeCall'],
                    'CustWaitDuration' => $value['CustWaitDuration'],
                    'UnitServe' => $value['UnitServe'],
                    'CounterNo' => $value['CounterNo'],
                    'Absent' => $value['Absent'],
                    'newUserId' => $value['UserId'],
                    'UserId' => $value['UserId'],
                    'Flag' => $value['Flag'],
                    'TimeEnd' => $value['TimeEnd'],
                    'Tservice' => $value['Tservice'],
                    'TWservice' => $value['TWservice'],
                    'TSLAservice' => $value['TSLAservice'],
                    'TOverSLA' => $value['TOverSLA'],
                    'QrSeqNumber' => null,
                    'OnlineQ' => $value['is_queue_online'] == 0 ? 'N' : 'Y',
                    'created_at' => now(),
                    'updated_at' => now()
                ];
                array_push($formatedReports, $params);
            }
        }

        if (Transaction::insert($formatedReports)) {
            $message = 'success';
            $code = 201;
        } else {
            $message = 'failed';
            $code = 422;
        }

        return response()->json(['message' => $message], $code);
    }

    public function syncFromLocal(Request $request)
    {
        $response = [];
        $localTime = now();
        $paramsTime = Carbon::parse($request->input('current_time'));
        $baseDt = $request->input('BaseDt');

        $company = MstBank::where('code', '=', $request->input('company_id'))->get()->first();
        $unitCode = UnitCode::where('code', '=', $request->input('UnitServe'))->get()->first();

        if (!($localTime->format('Ymd') == $baseDt) || empty($company) || empty($unitCode)) {
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
                'transaction_params_id' => $request->input('code_trx'),
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

    public function getNumberQueue(Request $request)
    {
        $localTime = now();
        $paramsTime = Carbon::parse($request->input('currentTime'));
        $startDate = $localTime->copy()->startOfDay();
        $endDate = $localTime->copy()->endOfDay();

        $company = MstBank::where('code', '=', $request->input('company_id'))->get()->first();
        $unitCode = UnitCode::where('code', '=', $request->input('unitCode'))->get()->first();

        if (empty($company) || empty($unitCode)) {
            $response = ['antrian' => null];
        } else {
            $newest = Queue::whereBetween('queue_for', [$startDate, $endDate])
                ->where('bank_id', '=', $company->id)
                ->where('bank_code', '=', $company->code)
                ->where('unit_code', '=', $unitCode->code)
                ->orderBy('number_queue', 'desc')
                ->first();

            if (empty($newest)) {
                $nextNumber = $this->formatQueue(1);
                $response = ['antrian' => $nextNumber];
            } else {
                $nextNumber = $this->formatQueue($newest->number_queue + 1);
            }

            $newRecord = [
                'ip' => 'sync',
                'id' => Str::uuid(),
                'queue_for' => $localTime,
                'number_queue' => $nextNumber,
                'unit_code' => $unitCode->code,
                'unit_code_name' => $unitCode->name,
                'bank_id' => $company->id,
                'bank_code' => $company->code,
                'bank_name' => $company->name,
                'bank_address' => $company->address,
                'OnlineQ' => 'N',
                'call' => 'N',
                'transaction_params_id' => $request->transaction_params_id,
            ];

            if (Queue::create($newRecord)) {
                $response = ['antrian' => $nextNumber];
            } else {
                $response = ['antrian' => null];
            }
        }

        return response()->json($response, 201);
    }

    public function formatQueue($que)
    {
        if (strlen($que) == self::MAX_QUEUE) {
            return $que;
        }

        return $this->formatQueue('0' . $que);
    }
}
