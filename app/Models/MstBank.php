<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstBank extends Model
{
    public $table = 'mst_bank';

    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'address',
        'latitude',
        'longitude',
        'city',
        'Area_Code',
        'KC_Code',
    ];

    public function scopeDistance($query, $latitude, $longitude, $distance, $unit = 'km')
    {
        $constant = $unit == 'km' ? 6371 : 3959;
        $haversine = "(
            $constant * acos(
                cos(radians(".$latitude.'))
                * cos(radians(`latitude`))
                * cos(radians(`longitude`) - radians('.$longitude.'))
                + sin(radians('.$latitude.')) * sin(radians(`latitude`))
            )
        )';

        return $query->selectRaw("$haversine AS distance")
            ->having('distance', '<=', $distance);
    }
}
