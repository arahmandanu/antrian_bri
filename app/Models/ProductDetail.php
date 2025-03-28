<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;

    public function masterProduct()
    {
        return $this->belongsTo(MasterProduct::class, 'master_product_id');
    }

    protected $fillable = [
        'master_product_id',
        'value',
        'suku_bunga',
        'display_number',
    ];
}
