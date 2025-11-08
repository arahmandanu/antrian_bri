<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoAdd extends Model
{
    use HasFactory;
    public const MAXVIDEOS = 1;
    public const VIDEOPATH = 'video_adds/';

    protected $fillable = [
        'title',
        'url',
    ];
}
