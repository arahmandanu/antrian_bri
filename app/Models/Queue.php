<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;

class Queue extends Model
{
    public $table = 'queue';

    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'ip',
        'id',
        'email',
        'queue_for',
        'number_queue',
        'unit_code_id',
        'unit_code',
        'bank_id',
        'bank_code',
        'bank_name',
        'bank_address',
    ];

    public function getBarcode()
    {
        $dateFor = Carbon::parse($this->queue_for)->format('Ymd');
        $data = "$dateFor-$this->number_queue-$this->unit_code-$this->bank_code";
        $a = new DNS2D;
        return $a->getBarcodeHTML($data, 'QRCODE');
    }
}
