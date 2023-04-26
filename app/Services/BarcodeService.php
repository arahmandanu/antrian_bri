<?php

namespace App\Services;

use App\Models\MstBank;
use App\Models\Queue;
use App\Models\UnitCode;
use Carbon\Carbon;

class BarcodeService
{
    public function generate(
        string $unitCode,
        string $queueFor,
        int $idBank,
        string $createdAt,
        string $ip
    ) {
        $unitCode = $this->getUnitCode($unitCode);
        $bank = $this->getBank($idBank);
        $numberQueue = $this->getNumberQueue($queueFor, $bank->code, $unitCode);
        $uniqId = $this->generateUniqId($queueFor, $bank->code, $unitCode->code, $numberQueue);

        $queue = $this->saveQueue([
            'ip' => $ip,
            'id' => $uniqId,
            'queue_for' => $queueFor,
            'number_queue' => $numberQueue,
            'unit_code_name' => $unitCode->name,
            'unit_code' => $unitCode->code,
            'bank_id' => $bank->id,
            'bank_code' => $bank->code,
            'bank_name' => $bank->name,
            'bank_address' => $bank->address,
            'OnlineQ' => 'Y',
            'call' => 'P',
        ]);

        return encrypt($queue->id);
    }

    private function getNumberQueue($queueFor, $bankCode, $unitCode)
    {
        $number = 0;
        $queueFor = Carbon::parse($queueFor);
        $queueNumber = Queue::select('number_queue')
            ->whereBetween('queue_for', [$queueFor->copy()->startOfDay(),  $queueFor->copy()->endOfDay()])
            ->where('bank_code', $bankCode)
            ->where('unit_code', $unitCode->code)
            ->latest()->first();

        if (isset($queueNumber)) {
            $number = $queueNumber->number_queue + 1;
        } else {
            $number = 1;
        }

        return $this->formatQueueNumber($number);
    }

    private function getUnitCode($unitCode)
    {
        return UnitCode::where('code', $unitCode)->first();
    }

    private function formatQueueNumber($queue)
    {
        if (strlen($queue) == 2) {
            $queue = '0' . $queue;
        } elseif (strlen($queue) == 1) {
            $queue = '00' . $queue;
        }

        return $queue;
    }

    private function getBank($idBank)
    {
        return MstBank::where('id', $idBank)->first();
    }

    private function saveQueue($data)
    {
        return Queue::create($data);
    }

    private function generateUniqId($queueFor, $bankCode, $unitCode, $numberQueue)
    {
        $formatedQueueuFor = Carbon::parse($queueFor)->format('dmY');

        return "{$formatedQueueuFor}{$bankCode}{$unitCode}{$numberQueue}";
    }
}
