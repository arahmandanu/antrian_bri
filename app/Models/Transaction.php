<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactioncust';

    use HasFactory;

    public function scopeTeller($query)
    {
        return $query->where('UnitServe', 'A');
    }

    public function scopeCs($query)
    {
        return $query->where('UnitServe', 'B');
    }

    public function actor()
    {
        return $this->hasOne(ButtonActor::class, 'code', 'UserId');
    }

    protected $fillable = [
        'BaseDt',
        'br_code',
        'SeqNumber',
        'TrxDesc',
        'TimeTicket',
        'TimeCall',
        'CustWaitDuration',
        'UnitServe',
        'CounterNo',
        'Absent',
        'UserId',
        'Flag',
        'TimeEnd',
        'Tservice',
        'TWservice',
        'TSLAservice',
        'TOverSLA',
        'QrSeqNumber',
        'OnlineQ',
        'newUserId'
    ];
}
