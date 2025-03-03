<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function list(Request $request)
    {
        $list = Currency::EnabledCurrencies()->get();
        $response = [];
        foreach ($list as $key => $value) {
            $value['url_flag'] = asset("flags/$value->url");
            array_push($response, $value);
        }
        return response()->json(['message' => 'success', 'data' => $response], 200);
    }
}
