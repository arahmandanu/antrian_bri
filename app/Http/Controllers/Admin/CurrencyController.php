<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.currency.index', [
            'curencies' => Currency::orderBy('display_number', 'asc')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $bankBranch) {}

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $kur)
    {
        $defaultNumber = range(1, 50);
        $used = Currency::where('id', '!=', $kur->id)->pluck('display_number')->toArray();

        $canUsed = [];
        $canUsed = array_merge($canUsed, array_diff($defaultNumber, $used));

        return view('admin.currency.edit', [
            'currency' => $kur,
            'displayNumbers' => $canUsed
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankBranch  $bankBranch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Currency $kur)
    {
        $validated = Validator::make($request->all(), [
            'jual' => 'required|string',
            'beli' => 'required|string',
            'display_number' => 'required|integer',
            'show' => 'required|boolean'
        ])->validate();

        if ($kur->update($request->input())) {
            flash()->success('Success update kurs');
        } else {
            flash()->error('Gagal update kurs');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $bankBranch)
    {
        //
    }
}
