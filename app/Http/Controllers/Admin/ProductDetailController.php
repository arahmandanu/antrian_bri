<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MasterProduct;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\Validator;

class ProductDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.product_detail.index', [
            'products' => MasterProduct::get(),
            'id' => json_encode(['id' => $request->input('product')])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product_detail.create', [
            'products' => MasterProduct::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'master_product_id' => 'required|integer|exists:master_products,id',
            'value' => 'required|string',
            'suku_bunga' => 'required|string',
            'display_number' => "required|integer|min:1|max:" . ProductDetail::MAXNUMBER[array_key_last(ProductDetail::MAXNUMBER)],
        ])->validate();

        if (ProductDetail::create($validated)) {
            flash()->success("Berhasil menambahkan product detail!");
        } else {
            flash()->danger("Gagal menambahkan product detail!");
        }

        return redirect()->route('admin.product_detail.index', ['product' => $validated['master_product_id']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(MasterProduct $product_detail)
    {
        $html = "";
        if (!$product_detail->productDetails->isEmpty()) {
            foreach ($product_detail->productDetails as $key => $value) {
                $html = $html . "<tr>" .
                    "<td>$value->display_number</td>" .
                    "<td>$value->value</td>" .
                    "<td>$value->suku_bunga</td>" .
                    "<td>
                        <div class='btn-group btn-group-sm' role='group' aria-label='Basic mixed styles example'>
                        <form method='POST' action='" . route('admin.product_detail.destroy', $value->id) . "'>
                            " . csrf_field() . "
                            " . method_field('DELETE')  . "
                            <button type='submit' class='btn btn-danger' onclick='deleteDetailProduct($value->id)'>Hapus</button>
                        </form>
                            <a href='" . route('admin.product_detail.edit', $value->id) . "' type='button' class='btn btn-success'>Edit</a>
                        </div>
                    </td>" .
                    "</tr>";
            }
        } else {
            $html =  $html . "<tr><td colspan='4' style='text-align: center;'>No Data</td></tr>";
        }

        return response()->json([
            "data" => $html
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductDetail $product_detail)
    {
        $displayNumber = $product_detail->masterProduct->productDetails->where('id', '!=', $product_detail->id)->pluck('display_number')->toArray();
        return view('admin.product_detail.edit', [
            'productDetail' => $product_detail,
            'masterProduct' => $product_detail->masterProduct->name,
            'displayNumber' => array_diff(ProductDetail::MAXNUMBER, $displayNumber)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductDetail $product_detail)
    {
        $validated = Validator::make($request->all(), [
            'value' => 'required|string',
            'suku_bunga' => 'required|string',
            'display_number' => "required|integer|min:1|max:" . ProductDetail::MAXNUMBER[array_key_last(ProductDetail::MAXNUMBER)],
        ])->validate();

        if ($product_detail->update($validated)) {
            flash()->success("Berhasil update produk detail!");
        } else {
            flash()->danger("Gagal update produk detail!");
        }

        return redirect()->route('admin.product_detail.index', ['product' => $product_detail->master_product_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductDetail $product_detail)
    {
        if ($product_detail->delete()) {
            flash()->success("Berhasil hapus produk detail!");
        } else {
            flash()->danger("Gagal hapus produk detail!");
        }
        return redirect()->route('admin.product_detail.index', ['product' => $product_detail->master_product_id]);
    }

    public function displayNumberByProductId(MasterProduct $productId)
    {
        $displayNumber = $productId->productDetails->pluck("display_number")->toArray();
        $canUsed = array_values(array_diff(ProductDetail::MAXNUMBER, $displayNumber));
        $html = "";
        if (!empty($canUsed)) {
            foreach ($canUsed as $key => $value) {
                $html = $html . "<option value='$value'> $value </option>";
            }
        } else {
            $html = $html . "<option> No Data Please Ask your administrator </option>";
        }
        return response()->json([
            "data" => $html
        ]);
    }
}
