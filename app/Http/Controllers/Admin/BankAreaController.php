<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBankAreaRequest;
use App\Http\Requests\Admin\UpdateBankAreaRequest;
use App\Models\BankArea;
use Illuminate\Http\Request;

class BankAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->name;
        $bankArea = BankArea::when($filter, function ($query, $filter) {
            $query->where('name', 'like', "%{$filter}%");
        })
            ->paginate(10);
        session()->flashInput($request->input());

        return view('admin.bank_area.index', [
            'bankAreas' => $bankArea,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bank_area.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBankAreaRequest $request)
    {
        BankArea::create($request->validated());

        flash()->success('Berhasil menyimpan data area');

        return redirect()->route('admin.bank_area.index');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(BankArea $bankArea)
    {
        return view('admin.bank_area.show', [
            'bankArea' => $bankArea,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(BankArea $bankArea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankArea  $bankArea
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBankAreaRequest $request, BankArea $bank_area)
    {
        $units = $bank_area->units();
        $bank_area->update($request->validated());

        $units->update([
            'Area_Code' => $bank_area->code,
        ]);

        flash()->success('Berhasil update data area');

        return redirect()->route('admin.bank_area.show', $bank_area->code);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankArea $bankArea)
    {
        //
    }
}
