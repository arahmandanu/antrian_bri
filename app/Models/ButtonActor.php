<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ButtonActor extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name'];

    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'UserId', 'code');
    }
}
