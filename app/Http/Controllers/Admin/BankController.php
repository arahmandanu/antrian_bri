<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBank;
use App\Http\Requests\UpdateBank;
use App\Models\BankArea;
use App\Models\BankBranch;
use App\Models\MstBank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $code = $request->code;
        $name = $request->name;
        $address = $request->address;

        $banks = MstBank::when($code, function ($query, $code) {
            $query->where('code', 'like', "%$code%");
        })
            ->when($name, function ($query, $name) {
                $query->where('name', 'like', "%$name%");
            })
            ->when($address, function ($query, $address) {
                $query->where('name', 'like', "%$address%");
            })
            ->orderBy('id')
            ->paginate(15);

        $banks->appends($request->all());
        session()->flashInput($request->input());

        return view('admin.bank.index', [
            'banks' => $banks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bank.create', [
            'bankAreas' => BankArea::all(),
            'bankBranches' => BankBranch::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBank $request)
    {
        $bankBranch = BankBranch::where('code', $request->validated('KC_Code'))->firstOrFail();
        $attr = array_merge($request->validated(), ['Area_Code' => $bankBranch->area->code]);
        $newBank = MstBank::create($attr);

        if ($newBank) {
            flash()->success('Berhasil menyimpan data Bank');

            return redirect()->route('banks.index');
        }

        flash()->error('Gagal menyimpan data Bank');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MstBank  $mstBank
     * @return \Illuminate\Http\Response
     */
    public function show(MstBank $bank)
    {
        if (! $bank) {
            abort(404);
        }

        return view('admin.bank.show', [
            'bank' => $bank,
            'bankBranches' => BankBranch::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MstBank  $mstBank
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBank $request, MstBank $bank)
    {
        abort_if(! $bank, 404);

        $bankBranch = BankBranch::where('code', $request->validated('KC_Code'))->firstOrFail();
        $attr = array_merge($request->validated(), ['Area_Code' => $bankBranch->area->code]);
        $bank->update($attr);

        flash()->success('Berhasil update Bank');

        return redirect()->route('banks.show', $bank->code);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MstBank  $mstBank
     * @return \Illuminate\Http\Response
     */
    public function destroy(MstBank $bank)
    {
        abort_if(! $bank, 404);

        if ($bank->delete()) {
            flash()->success('Berhasil delete Bank');
        } else {
            flash()->error('Gagal delete Bank');
        }

        return back();
    }
}
