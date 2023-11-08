<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
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
    function index()
    {
        return view("login");
    }

    function index_user()
    {
        return view("users.index", ["users" => User::get()]);
    }

    function dashboard()
    {
        return view("index");
    }

    function login(LoginUserRequest $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($login)) {
            return redirect("index");
        } else {
            return redirect("login")->withErrors("Email/Password not Valid");
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect("login");
    }

    function register()
    {
        return view("register");
    }

    function register_user(StoreUserRequest $request)
    {
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
            return view("index");
        } else {
            return redirect("login")->withErrors("Email/Password not Valid");
        }
    }

    public function create(): View
    {
        return view("users.create");
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
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
