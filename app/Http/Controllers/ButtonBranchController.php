<?php

namespace App\Http\Controllers;

use App\Http\Requests\Operator\StoreButtonBranchRequest;
use App\Http\Requests\Operator\UpdateButtonBranchRequest;
use App\Models\ButtonActor;
use App\Models\ButtonBranch;
use Illuminate\Http\Request;

class ButtonBranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->button;
        $buttonBranch = ButtonBranch::when($filter, function ($query, $filter) {
            $query->where('button', $filter);
        })->where('bank_code', auth()->user()->unit_code)
            ->with('branch')
            ->with('actor')
            ->orderBy('button')
            ->get();

        return view('admin.button_branch.index', [
            'buttonBranchs' => $buttonBranch,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.button_branch.create', [
            'actors' => ButtonActor::all(),
            'buttons' => ButtonBranch::BUTTON,
            'actor' => ButtonActor::select('code as id', 'name as text')->take(1)->get()->toArray(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreButtonBranchRequest $request)
    {
        $attr = array_merge($request->validated(), ['bank_code' => auth()->user()->unit_code]);
        ButtonBranch::create($attr);

        flash()->success('Berhasil menyimpan tombol user');

        return redirect()->route('operator.button.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ButtonBranch  $buttonBranch
     * @return \Illuminate\Http\Response
     */
    public function show(ButtonBranch $button)
    {
        return view('admin.button_branch.show', [
            'buttonBranch' => $button,
            'actors' => ButtonActor::all(),
            'buttons' => ButtonBranch::BUTTON,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(ButtonBranch $buttonBranch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ButtonBranch  $buttonBranch
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateButtonBranchRequest $request, ButtonBranch $button)
    {
        $button->update($request->validated());
        flash()->success('Berhasil mengubah data tombol');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(ButtonBranch $buttonBranch)
    {
        //
    }
}
