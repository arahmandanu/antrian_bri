<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBankBranchesRequest;
use App\Http\Requests\Admin\UpdateBankBranchRequest;
use App\Models\BankArea;
use App\Models\BankBranch;
use Illuminate\Http\Request;

class BankBranchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->name;
        $bankBranches = BankBranch::when($filter, function ($query, $filter) {
            $query->where('name', 'like', "%{$filter}%");
        })
            ->with('area')
            ->paginate(10);
        session()->flashInput($request->input());

        return view('admin.bank_branches.index', [
            'bankBranches' => $bankBranches,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bank_branches.create', [
            'bankAreas' => BankArea::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBankBranchesRequest $request)
    {
        BankBranch::create($request->validated());
        flash()->success('Berhasil menyimpan data branch');

        return redirect()->route('admin.bank_branches.index');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(BankBranch $bankBranch)
    {
        return view('admin.bank_branches.show', [
            'bankAreas' => BankArea::all(),
            'bankBranch' => $bankBranch,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(BankBranch $bankBranch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankBranch  $bankBranch
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBankBranchRequest $request, BankBranch $bank_branch)
    {
        $relation = $bank_branch->units();
        $bank_branch->update($request->validated());

        $relation->update([
            'Area_Code' => $bank_branch->area_code,
        ]);

        flash()->success('Berhasil update data branch');

        return redirect()->route('admin.bank_branches.show', $bank_branch->code);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankBranch $bankBranch)
    {
        //
    }
}
