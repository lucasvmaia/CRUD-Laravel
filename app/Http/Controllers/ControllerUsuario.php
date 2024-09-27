<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tb_usuario;

class ControllerUsuario extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = tb_usuario::all();
        return view('usuarios', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('criarUsuario');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $mensagens = [
            'required' => 'O campo :attribute não pode estar em branco',
            'usuarioEmail.unique' => 'Email já cadastrado',
            'usuarioSenha.min' => 'Senha minimo 5 caracteres',
            'usuarioSenha.max' => 'Senha maxima 10 caracteres'
        ];

        $request->validate([
            'usuarioNome' => 'required',
            'usuarioEmail' => 'required|email|unique:tb_usuarios,email',
            'usuarioSenha' => 'required|min:5|max:10'
        ], $mensagens);

        $usuario = new tb_usuario();
        $usuario->id_perfil = 1;
        $usuario->nome = $request->input('usuarioNome');
        $usuario->email = $request->input('usuarioEmail');
        $usuario->senha = $request->input('usuarioSenha');
        $usuario->save();
        return redirect('/usuarios');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = tb_usuario::find($id);
        if(isset($user))
        {
            return view('editarUsuario', compact('user'));
        }
        return redirect('/usuarios');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mensagens = [
            'required' => 'O campo :attribute não pode estar em branco',
            'usuarioEmail.unique' => 'Email já cadastrado',
            'usuarioSenha.min' => 'Senha minimo 5 caracteres',
            'usuarioSenha.max' => 'Senha maxima 10 caracteres'
        ];

        $request->validate([
            'usuarioNome' => 'required',
            'usuarioEmail' => 'required|email|unique:tb_usuarios,email',
            'usuarioSenha' => 'required|min:5|max:10'
        ], $mensagens);

        $user = tb_usuario::find($id);
        if(isset($user))
        {
            $user->nome = $request->input('usuarioNome');
            $user->email = $request->input('usuarioEmail');
            $user->senha = $request->input('usuarioSenha');
            $user->save();
        }
        return redirect('/usuarios');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = tb_usuario::find($id);
        if(isset($user))
        {
            $user->delete();
        }
        return redirect('/usuarios');
    }
}
