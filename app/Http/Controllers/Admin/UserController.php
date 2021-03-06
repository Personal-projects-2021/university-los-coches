<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin.users.index')->only('index');
        $this->middleware('can:admin.users.edit')->only('edit', 'update');
        $this->middleware('can:admin.users.destroy')->only('destroy');
    }

    public function index()
    {
        // $users = User::doesntHave('roles')->get();
        // return view('admin.users.index', compact('users'));
        return view('admin.users.index');
    }

    public function edit(User $user)
    {   
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // return $request;
        $request->validate([
            'email' => "required|email|unique:users,email,$user->id",
            'state_id' => 'required|integer|exists:states,id'
        ]);

        $user->update($request->only('email','state_id'));

        $name = $user->name;

        toast("Usuario $name, ha sido actualizado correctamente",'success');
        
        return redirect()->route('admin.users.edit', compact('user'));
        // return redirect()->route('admin.users.index');
    }

    public function destroy(User $user)
    {
        $name = $user->name;
        $user->delete();
        Alert::info("Usuario $name", "Se ha eleminado correctamente");
        return redirect()->route('admin.users.index')->with('info', 'El usuario: '.$name.', se ha eleminado correctamente.');
    }
}
