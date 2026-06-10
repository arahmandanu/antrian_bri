<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoAdd extends Model
{
    use HasFactory;
    public const MAXVIDEOS = 3;
    public const VIDEOPATH = 'video_adds/';
    public const TYPE = [
        'all' => 'all',
        'kcp' => 'kcp',
        'unit' => 'unit',
    ];

    protected $fillable = [
        'title',
        'url',
        'type',
    ];

    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }
}
