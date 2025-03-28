<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MasterProductController extends Controller
{
    protected $maxNumber  = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.master_products.index', [
            'masterProducts' => MasterProduct::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $usedNumber = MasterProduct::get()->pluck('display_number')->toArray();
        return view('admin.master_products.create', [
            'display' => array_diff(MasterProduct::MAXNUMBER, $usedNumber)
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
            'name' => 'required|string',
            'display_number' => "required|integer|min:1|max:" . MasterProduct::MAXNUMBER[array_key_last(MasterProduct::MAXNUMBER)] . "|unique:master_products,display_number",
            'show' => 'boolean',
        ])->validate();

        if (!isset($validated['show'])) {
            $validated['show'] = false;
        }

        if (MasterProduct::create($validated)) {
            flash()->success("Berhasil membuat product baru");
        } else {
            flash()->danger("Gagal membuat product baru");
        }

        return redirect()->route('admin.product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterProduct  $masterProduct
     * @return \Illuminate\Http\Response
     */
    public function show(MasterProduct $masterProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterProduct  $masterProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterProduct $product)
    {
        $usedNumber = MasterProduct::where('id', '!=', $product->id)->pluck('display_number')->toArray();
        return view('admin.master_products.edit', [
            'product' => $product,
            'display' => array_diff(MasterProduct::MAXNUMBER, $usedNumber)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterProduct  $masterProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterProduct $product)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required|string',
            'display_number' => "required|integer|min:1|max:" . MasterProduct::MAXNUMBER[array_key_last(MasterProduct::MAXNUMBER)] . "|unique:master_products,display_number,$product->id",
            'show' => 'boolean',
        ])->validate();

        if (!isset($validated['show'])) {
            $validated['show'] = false;
        }

        if ($product->update($validated)) {
            flash()->success("Berhasil merubah product");
        } else {
            flash()->danger("Gagal merubah product");
        }

        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterProduct  $masterProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, MasterProduct $masterProduct) {}
}
