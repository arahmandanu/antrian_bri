<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreButtonActorRequest;
use App\Http\Requests\UpdateButtonActorRequest;
use App\Models\ButtonActor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
            'actors' => $actor,
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
     * @return \Illuminate\Http\Response
     */
    public function store(StoreButtonActorRequest $request)
    {
        $user = [];
        $user['code'] = $request->validated('code');
        $user['name'] = Str::upper($request->validated('name'));
        ButtonActor::create($user);

        flash()->success('Berhasil menyimpan user');

        return redirect()->route('operator.button_actor.index');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(ButtonActor $buttonActor)
    {
        return view('admin.button_actor.show', [
            'actor' => $buttonActor,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(ButtonActor $buttonActor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\ButtonActor  $buttonActor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateButtonActorRequest $request, ButtonActor $button_actor)
    {
        $user = [];
        $user['code'] = $request->validated('code');
        $user['name'] = Str::upper($request->validated('name'));
        $button_actor->update($user);

        flash()->success('Berhasil update data user');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(ButtonActor $buttonActor)
    {
        //
    }

    public function list(Request $request)
    {
        $data = [];
        if ($request->ajax()) {
            $search = $request->name;
            $result = ButtonActor::select('code as id', 'name as text')
                ->when($search, function ($query, $search) {
                    $query->where('name', 'like', "%$search%");
                })
                ->limit(5)
                ->get();
            $data = $result->toArray();
        }

        return json_encode($data);
    }
}
