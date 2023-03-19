<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankBranch extends Model
{
    use HasFactory;

    protected $fillable = ['area_code', 'code', 'name'];

    public function area()
    {
        return $this->hasOne(BankArea::class, 'code', 'area_code');
    }
}
