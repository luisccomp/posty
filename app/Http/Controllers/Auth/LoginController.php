<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        if (!Auth::attempt($request->only('email', 'password'), $request->remember))
        {
            return back()->with('status', 'Invalid login credentials');
        }

        // Ou de forma alternativa, podemos utilizar um conjunto de chave e valor...
        // Auth::attempt([
        //     'email' => $request->email,
        //     'password' => $request->password
        // ]);

        return redirect()->route('dashboard');
    }
}
