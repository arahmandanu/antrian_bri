<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'name',
        'jual',
        'beli',
        'show',
        'display_number'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'show' => 'boolean',
    ];

    public function scopeEnabledCurrencies($query)
    {
        return $query->where('show', true)->orderBy('display_number', 'asc');
    }
}
