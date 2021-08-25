<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vote;
use App\Models\Division;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        $divisions = Division::all();

        return view('user.index', ['users' => $users, 'divisions' => $divisions]);
    }

    public function store(Request $request) {
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'role' => $request->role,
            'division_id' => $request->division,
            'password' => bcrypt('1234')
        ]);

        return redirect('/user');
    }

    public function edit($user_id) {
        $users = User::where('id', $user_id)->get();
        $divisions = Division::all();

        return view('user.edit', ['users' => $users, 'divisions' => $divisions]);
    }

    public function update(Request $request, $user_id) {
        $user = User::find($user_id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->role = $request->role;
        $user->division_id = $request->division;
        $user->save();

        return redirect('/user');
    }

    public function delete($user_id) {
        Vote::where('user_id', $user_id)->delete();
        User::find($user_id)->delete();

        return redirect('/user');
    }
}
