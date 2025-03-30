<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MasterProduct;
use App\Models\ProductDetail;
use Illuminate\Http\Request;

class SyncProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [];
        $masterProduct = MasterProduct::Show()->get();
        foreach ($masterProduct as $value) {
            $details = [];
            $details['name'] = $value->name;
            $details['data'] = $value->productDetails;

            array_push($data, $details);
        }

        return response()->json([
            'data' => $data
        ]);
    }
}
