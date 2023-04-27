<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddUser;
use App\Http\Requests\EditUser;
use App\Models\MstBank;
use App\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.index', [
            'users' => User::ListByRole()->with('roles')->with('unit')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create', [
            'roles' => Role::ByRole()->get(),
            'unitBanks' => MstBank::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddUser $request)
    {
        $attribute = $request->validated();
        $attribute['password'] = bcrypt($request->validated()['password']);
        $user = User::create($attribute);
        $role = Role::find($request->validated('role'));
        $user->assignRole($role);
        flash()->success('Berhasil membuat user baru');

        return redirect()->route('user.show', $user->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.user.show', [
            'user' => $user,
            'roles' => Role::all(),
            'unitBanks' => MstBank::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUser $request, User $user)
    {
        if ($request->validated('role') !== null) {
            $newRole = Role::find($request->validated('role'));
            $user->removeRole($user->roles->first());
            $user->assignRole($newRole);
        }

        $attribute = $request->validated();
        if (isset($request->validated()['password'])) {
            $attribute['password'] = bcrypt($request->validated()['password']);
        }

        if ($user->update($attribute)) {
            flash()->success('Berhasil update data user');
        } else {
            flash()->danger('Gagal update data user');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
