<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tb_afiliado;

class ControllerAfiliado extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function indexView()
    // {
    //     return view('afiliados');
    // }


    public function index()
    {
        $afiliados = tb_afiliado::all();
        return view('afiliados', compact('afiliados'));
        // $afiliados = tb_afiliado::all();
        // return $afiliados->toJson();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $afiliados = new tb_afiliado();
        $afiliados->id_perfil = 2;
        $afiliados->email = $request->input('afiliadoEmail');
        $afiliados->nome = $request->input('afiliadoNome');
        $afiliados->cpf = $request->input('afiliadoCPF');
        $afiliados->dataNascimento = $request->input('afiliadoDtNasc');
        $afiliados->telefone = $request->input('afiliadoTel');
        $afiliados->endereco = $request->input('afiliadoEnd');
        $afiliados->cidade = $request->input('afiliadoCidade');
        $afiliados->estado = $request->input('afiliadoEstado');
        $afiliados->save();
        return redirect('/afiliados');
        // return json_encode($afiliados);
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
        $afiliados = tb_afiliado::find($id);
        if(isset($afiliados)){
            return view('editarAfiliado', compact('afiliados'));
        }
        return redirect('/afiliados');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $afiliados = tb_afiliado::find($id);
        if(isset($afiliados)){
            $afiliados->id_perfil = 2;
            $afiliados->email = $request->input('afiliadoEmail');
            $afiliados->nome = $request->input('afiliadoNome');
            $afiliados->cpf = $request->input('afiliadoCPF');
            $afiliados->dataNascimento = $request->input('afiliadoDtNasc');
            $afiliados->telefone = $request->input('afiliadoTel');
            $afiliados->endereco = $request->input('afiliadoEnd');
            $afiliados->cidade = $request->input('afiliadoCidade');
            $afiliados->estado = $request->input('afiliadoEstado');
            $afiliados->save();
        }
        return redirect('/afiliados');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $afiliado = tb_afiliado::find($id);
        if(isset($afiliado)){
            $afiliado->delete();
        }
        return redirect('/afiliados');
    }
}
