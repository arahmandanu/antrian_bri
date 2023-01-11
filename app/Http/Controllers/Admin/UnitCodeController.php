<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUnitCodeRequest;
use App\Http\Requests\UpdateUnitCodeRequest;
use App\Models\UnitCode;
use Illuminate\Http\Request;

class UnitCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $code = $request->code;
        $unitCodes = UnitCode::when($code, function ($query, $code) {
            $query->where('code', 'like', "%$code%");
        })
            ->paginate(15);
        $unitCodes->appends($request->all());
        session()->flashInput($request->input());

        return view('admin.unit_code.index', [
            'unitCodes' => $unitCodes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.unit_code.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUnitCodeRequest $request)
    {
        $unitCode = UnitCode::create($request->validated());

        if ($unitCode) {
            flash()->success('Berhasil membuat Unit Code');

            return redirect()->route('unit_codes.show', $unitCode->id);
        }

        flash()->error('Gagal Membuat Unit Code');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UnitCode  $unitCode
     * @return \Illuminate\Http\Response
     */
    public function show(UnitCode $unit_code)
    {
        abort_if(! $unit_code, 404);

        return view('admin.unit_code.show', [
            'unit_code' => $unit_code,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UnitCode  $unitCode
     * @return \Illuminate\Http\Response
     */
    public function edit(UnitCode $unit_code)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UnitCode  $unitCode
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUnitCodeRequest $request, UnitCode $unit_code)
    {
        abort_if(! $unit_code, 404);

        if ($unit_code->update($request->validated())) {
            flash()->success('Berhasil update Bank');
        } else {
            flash()->error('Gagal update Bank');
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UnitCode  $unitCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(UnitCode $unit_code)
    {
        abort_if(! $unit_code, 404);

        if ($unit_code->delete()) {
            flash()->success('Berhasil delete Unit Code');
        } else {
            flash()->error('Gagal delete Unit Code');
        }

        return back();
    }
}
