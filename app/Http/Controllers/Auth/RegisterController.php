<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        // Porém, quando o middleware é passado pelo construtor, o mesmo será chamado durante as requisições de toras
        // as rotas.
        $this->middleware(['guest']);
    }

    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Auth::attempt($request->only('email', 'password'));

        // Alternativamente podemos utilizar essa forma para obter os dados da requisição
        // Auth::attempt([
        //     'email' => $request->email,
        //     'password' => $request->password
        // ]);

        return redirect()->route('dashboard');
    }
}
