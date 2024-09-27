<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tb_comissao;

class ControllerComissao extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('comissoes');
        $comissoes = tb_comissao::all();
        return view('comissoes', compact('comissoes'));
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
        $mensagens = [
            'required' => 'O campo :attribute não pode estar em branco',
            'afiliadoCPF.unique' => 'CPF já cadastrado'
        ];

        $request->validate([
            'comissaoValor' => 'required',
            'afiliadoCPF' => 'required|unique:tb_comissaos,afiliado'
        ], $mensagens);

        $comissoes = new tb_comissao();
        $comissoes->valor = $request->input('comissaoValor');
        $comissoes->afiliado = $request->input('afiliadoCPF');
        $comissoes->data = \Carbon\Carbon::now();
        $comissoes->save();
        return redirect('/comissoes');
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
        $comissoes = tb_comissao::find($id);
        if(isset($comissoes)){
            return view('editarComissao', compact('comissoes'));
        }
        return redirect('/comissoes');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mensagens = [
            'required' => 'O campo :attribute não pode estar em branco',
            'afiliadoCPF.unique' => 'CPF já cadastrado'
        ];

        $request->validate([
            'comissaoValor' => 'required',
            'afiliadoCPF' => 'required|unique:tb_comissaos,afiliado'
        ], $mensagens);

        $comissoes = tb_comissao::find($id);
        if(isset($comissoes)){
            $comissoes->valor = $request->input('comissaoValor');
            $comissoes->afiliado = $request->input('afiliadoCPF');
            $comissoes->data = \Carbon\Carbon::now();
            $comissoes->save();
        }
        return redirect('/comissoes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comissoes = tb_comissao::find($id);
        if(isset($comissoes)){
            $comissoes->delete();
        }
        return redirect('/comissoes');
    }
}
