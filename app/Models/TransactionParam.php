<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionParam extends Model
{
    use HasFactory;

    public function unitCode()
    {
        return $this->belongsTo(UnitCode::class);
    }

    protected $fillable = [
        'unit_code_id',
        'code',
        'name'
    ];
}
