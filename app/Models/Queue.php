<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Milon\Barcode\DNS2D;

class Queue extends Model
{
    public $table = 'queue';

    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'ip',
        'id',
        'queue_for',
        'number_queue',
        'unit_code',
        'bank_id',
        'bank_code',
        'bank_name',
        'bank_address',
        'unit_code_name',
        'OnlineQ',
        'call',
        'transaction_params_id'
    ];

    public function getBarcode()
    {
        $dateFor = Carbon::parse($this->queue_for)->format('dmY');
        $data = "$dateFor" . "$this->bank_code" . "$this->unit_code" . $this->formatQueueNumber($this->number_queue) . $this->transaction_params_id;
        $a = new DNS2D;

        return $a->getBarcodeHTML($data, 'QRCODE');
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
}
