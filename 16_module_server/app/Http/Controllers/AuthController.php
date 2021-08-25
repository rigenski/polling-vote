<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request) {
        if(Auth::attempt($request->only('username', 'password'))) {
            if($request->password == '1234') {
                return redirect('/change_password');
            }

            return redirect('/');
        }
        return redirect('/login');
    }

    public function changePassword(Request $request) {
        $old = $request->old_password;
        $new = $request->new_password;
        $conf = $request->conf_password;

        if (Hash::check($old, auth()->user()->password)) {
            if ($new == $conf) {
                $user = User::find(auth()->user()->id);
                $user->password = bcrypt($new);
                $user->save();

                Auth::logout();

                return redirect('/login');
            }

            return redirect('/change_password');
        }

        return redirect('/change_password');
    }

    public function register(Request $request) {

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'role' => 'user',
            'division_id' => $request->division,
            'password' => bcrypt('1234'),
        ]);

        return redirect('/login');
    }

    public function logout() {
        Auth::logout();

        return redirect('/login');
    }

    public function indexRegister() {
        $divisions = Division::all();

        return view('register', ['divisions' => $divisions]);
    }
}
