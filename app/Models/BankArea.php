<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankArea extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name'];

    protected $primaryKey = 'code';

    public $incrementing = false;

    public function bankBranches()
    {
        return $this->hasMany(BankBranch::class, 'area_code', 'code');
    }

    public function units()
    {
        return $this->hasMany(MstBank::class, 'Area_Code', 'code');
    }
}
