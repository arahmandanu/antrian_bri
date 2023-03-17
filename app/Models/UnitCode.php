<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitCode extends Model
{
    public $table = 'unit_codes';

    use HasFactory;

    protected $fillable = [
        'code',
        'name',
    ];
}
