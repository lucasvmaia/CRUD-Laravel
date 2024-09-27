@extends('layouts.app', ["current" => "comissoes"])

@section('body')
    <div class="card border border-0 shadow p-3 mb-5 bg-body-tertiary rounded">
        <div class="card-header">
            Editar Usuário {{$comissoes->id}}
        </div>
        <div class="card-body">
            <form action="/comissoes/{{$comissoes->id}}" method="POST" class="row g-3">
                @csrf
                <div class="col-md-4">
                  <label for="comissaoValor" class="form-label">Valor</label>
                  <input step=".01" value="{{$comissoes->valor}}" placeholder="Digite seu valor" type="number" class="form-control {{ $errors->has('comissaoValor') ? 'is-invalid' : ''}}" id="comissaoValor" name="comissaoValor">
                  @if($errors->has('comissaoValor'))
                  <div class="invalid-feedback">
                    {{ $errors->first('comissaoValor')}}
                  </div>
                @endif
                </div>
                <div class="col-md-4">
                  <label for="afiliadoCPF" class="form-label">Afiliado (CPF)</label>
                  <input value="{{$comissoes->afiliado}}" placeholder="Digite seu cpf" type="text" class="form-control {{ $errors->has('afiliadoCPF') ? 'is-invalid' : ''}}" id="afiliadoCPF" name="afiliadoCPF">
                  @if($errors->has('afiliadoCPF'))
                  <div class="invalid-feedback">
                    {{ $errors->first('afiliadoCPF')}}
                  </div>
                @endif
                </div>
                <div class="col-12">
                  <button type="submit" class="btn btn-sm btn-primary">Editar</button>
                  <a class="btn btn-sm btn-danger" href="{{ route('comissoes') }}">Voltar</a>
                </div>
              </form>
            
        </div>
  </div>
@endsection