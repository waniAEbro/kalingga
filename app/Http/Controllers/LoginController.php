<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Contracts\View\View;

class LoginController extends Controller
{
    function index(){
        return view("login");
    }

    function index_user(){
        return view("users.index", ["users" => User::get()]);
    }

    function dashboard(){
        return view("index");
    }

    function login(Request $request){

        Session::flash('email', $request->email);
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ],[
            'email.required' => 'Email Wajib Diisi',
            'password.required' => 'Password Wajib Diisi',
        ]);

        $login = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($login)) {
            return redirect("index");
        } else{
            return redirect("login")->withErrors("Email/Password not Valid");
        }

    }

    function logout(){
        Auth::logout();
        return redirect("login");
    }

    function register(){
        return view("register");
    }

    function register_user(Request $request){
        // Session::flash('name', $request->name);
        // Session::flash('email', $request->email);
        // Session::flash([
        //     'name', $request->name,
        //     'email', $request->email,
        // ]);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ],[
            'name.required' => 'Nama Wajib Diisi',
            'email.required' => 'Email Wajib Diisi',
            'email.email' => 'Email Harus Valid',
            'email.unique' => 'Email Sudah Perna Digunakan, Silahkan Gunakan Email yang Lain',
            'password.required' => 'Password Wajib Diisi',
            'password.min' => 'Password Minimal 8 Karakter',
        ]);

        User::create([
            "name" => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $login = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($login)) {
            // return redirect("dashboard");
            return view("index");
        } else{
            return redirect("login")->withErrors("Email/Password not Valid");
        }
    }

    public function create() :View
    {
        return view("users.create");
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        // @dd($request);
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ],[
            'name.required' => 'Nama Wajib Diisi',
            'email.required' => 'Email Wajib Diisi',
            'password.required' => 'Password Wajib Diisi',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect("/users");
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect("/users");
    }
}
