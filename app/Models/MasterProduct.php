<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class MasterProduct extends Model
{
    use HasFactory;
    public const MAXNUMBER = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

    public function productDetails()
    {
        return $this->hasMany(ProductDetail::class)->orderBy('display_number', 'asc');
    }

    public function scopeShow(Builder $query): void
    {
        $query->where('show', true)->orderBy('display_number', 'asc');
    }

    protected $fillable = [
        'name',
        'display_number',
        'show',
    ];

    protected $casts = [
        'show' => 'boolean',
    ];
}
