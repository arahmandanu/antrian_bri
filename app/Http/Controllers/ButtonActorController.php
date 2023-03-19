<?php

namespace App\Http\Controllers;

use App\Models\ButtonActor;
use App\Http\Requests\StoreButtonActorRequest;
use App\Http\Requests\UpdateButtonActorRequest;
use Illuminate\Http\Request;

class ButtonActorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->name;

        $actor = ButtonActor::when($filter, function ($query, $filter) {
            return $query->where('name', 'like', "%{$filter}%");
        })
            ->paginate(10);

        session()->flashInput($request->input());

        return view('admin.button_actor.index', [
            'actors' => $actor
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.button_actor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreButtonActorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreButtonActorRequest $request)
    {
        ButtonActor::create($request->validated());

        flash()->success('Berhasil menyimpan user');
        return redirect()->route('operator.button_actor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ButtonActor  $buttonActor
     * @return \Illuminate\Http\Response
     */
    public function show(ButtonActor $buttonActor)
    {
        return view('admin.button_actor.show', [
            'actor' => $buttonActor
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ButtonActor  $buttonActor
     * @return \Illuminate\Http\Response
     */
    public function edit(ButtonActor $buttonActor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateButtonActorRequest  $request
     * @param  \App\Models\ButtonActor  $buttonActor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateButtonActorRequest $request, ButtonActor $button_actor)
    {
        $button_actor->update($request->validated());

        flash()->success('Berhasil update data user');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ButtonActor  $buttonActor
     * @return \Illuminate\Http\Response
     */
    public function destroy(ButtonActor $buttonActor)
    {
        //
    }
}
