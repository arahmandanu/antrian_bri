<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ButtonBranch extends Model
{
    use HasFactory;

    public $table = 'button_branch';
    protected $fillable = ['bank_code', 'button', 'actor_code'];

    public const BUTTON = [
        'A', 'B', "C", 'D', 'E', "F", 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'
    ];

    public function buttonList()
    {
        return $this::BUTTON;
    }

    public function branch()
    {
        return $this->hasOne(MstBank::class, 'code', 'bank_code');
    }

    public function actor()
    {
        return $this->hasOne(ButtonActor::class, 'code', 'actor_code');
    }
}
