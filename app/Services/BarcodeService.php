<?php

namespace App\Services;

use App\Models\MstBank;
use App\Models\Queue;
use App\Models\UnitCode;
use Carbon\Carbon;
use Illuminate\Support\Str;

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

        $queue = $this->saveQueue([
            'ip' => $ip,
            'id' => Str::uuid()->toString(),
            'queue_for' => $queueFor,
            'number_queue' => $this->getNumberQueue($queueFor, $bank->code, $unitCode),
            'unit_code_name' => $unitCode->name,
            'unit_code' => $unitCode->code,
            'bank_id' => $bank->id,
            'bank_code' => $bank->code,
            'bank_name' => $bank->name,
            'bank_address' => $bank->address,
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
            ->where('unit_code', $unitCode)
            ->max('number_queue');

        if (isset($queueNumber)) {
            $number = $queueNumber + 1;
        } else {
            $number = 1;
        }

        return $number;
    }

    private function getUnitCode($unitCode)
    {
        return UnitCode::where('code', $unitCode)->first();
    }

    private function getBank($idBank)
    {
        return MstBank::where('id', $idBank)->first();
    }

    private function saveQueue($data)
    {
        return Queue::create($data);
    }
}
