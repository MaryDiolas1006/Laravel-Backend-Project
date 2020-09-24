<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', User::class);
        $users = User::all();
        return view('users.index')->with('users', $users);
    }


    public function create()
    {
        $this->authorize('create', User::class);
        return view('users.create');
    }


    public function store(Request $request)
    {
        $this->authorize('create', User::class);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|numeric'
        ]);

        $user = new User($validatedData);
        $user->password = Hash::make($user->password);
        $user->save();

        return redirect(route('users.index'))->with('message', "{$user->name} is added successfully!")->with('alert', 'success');
    }


    public function edit(User $user)
    {
        $this->authorize('update', User::class);
        return view('users.edit')->with('user', $user);
    }


    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|numeric'
        ]);
        $user->update($validatedData);
        $user->password = Hash::make($user->password);
        $user->save();
        return redirect(route('users.index'))->with('message', "User is updated successfully!")->with('alert', 'info');
    }


     public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();
        return redirect(route('users.index'))->with('message', "{$user->name} has been deleted.")->with('alert', 'warning');
    }

}
