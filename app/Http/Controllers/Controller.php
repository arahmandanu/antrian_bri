<?php

namespace App\Http\Controllers;

use App\Http\Traits\AbstractTrait;
use App\Http\Traits\DateTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, AbstractTrait, DateTrait;
}
