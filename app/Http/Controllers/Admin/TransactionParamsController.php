<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransactionParam;
use App\Models\UnitCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionParamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.transaction_params.index', [
            'transactionParams' => TransactionParam::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.transaction_params.create', [
            'unitCodes' => UnitCode::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'unit_code_id' => 'required|string|exists:unit_codes,id',
            'code' => 'required|string|min:4|max:4|unique:transaction_params,code',
            'name' => 'required',
        ])->validate();

        if (TransactionParam::create($validated)) {
            flash()->success('Sukses membuat jenis transaksi');
        } else {
            flash()->error('Gagal membuat jenis transaksi');
        }

        return redirect()->route('admin.transactionParams.index');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(TransactionParam $transactionParam)
    {
        return view('admin.transaction_params.show', [
            'transactionParams' => $transactionParam,
            'unitCodes' => UnitCode::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(TransactionParam $transactionParam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransactionParam $transactionParam)
    {
        $validated = Validator::make($request->all(), [
            'unit_code_id' => 'required|string|exists:unit_codes,id',
            'code' => "required|string|min:4|max:4|unique:transaction_params,code,$transactionParam->id",
            'name' => 'required',
        ])->validate();

        if ($transactionParam->update($validated)) {
            flash()->success('Sukses mengubah jenis transaksi');
        } else {
            flash()->error('Gagal mengubah jenis transaksi');
        }

        return redirect()->route('admin.transactionParams.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransactionParam $transactionParam)
    {
        //
    }
}
