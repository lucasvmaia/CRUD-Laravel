@extends('layouts.app', ["current" => "usuarios"])

@section('body')
    <div class="card border border-0 shadow p-3 mb-5 bg-body-tertiary rounded">
        <div class="card-header">
            Editar Usuário {{$user->id}}
        </div>
        <div class="card-body">
            <form action="/usuarios/{{$user->id}}" method="POST" class="row g-3">
                @csrf
                <div class="col-md-4">
                  <label for="usuarioEmail" class="form-label">Email</label>
                  <input value="{{$user->email}}" placeholder="Digite seu email" type="email" class="form-control {{ $errors->has('usuarioEmail') ? 'is-invalid' : ''}}" id="usuarioEmail" name="usuarioEmail">
                  @if($errors->has('usuarioEmail'))
                  <div class="invalid-feedback">
                    {{ $errors->first('usuarioEmail')}}
                  </div>
                @endif
                </div>
                <div class="col-md-4">
                  <label for="usuarioNome" class="form-label">Nome</label>
                  <input value="{{$user->nome}}" placeholder="Digite seu nome" type="text" class="form-control {{ $errors->has('usuarioNome') ? 'is-invalid' : ''}}" id="usuarioNome" name="usuarioNome">
                  @if($errors->has('usuarioNome'))
                  <div class="invalid-feedback">
                    {{ $errors->first('usuarioNome')}}
                  </div>
                @endif
                </div>
                <div class="col-md-4">
                  <label for="usuarioSenha" class="form-label">Senha</label>
                  <input value="{{$user->senha}}" placeholder="Digite sua senha" name="usuarioSenha" type="password" class="form-control {{ $errors->has('usuarioSenha') ? 'is-invalid' : ''}}" id="usuarioSenha">
                  @if($errors->has('usuarioSenha'))
                  <div class="invalid-feedback">
                    {{ $errors->first('usuarioSenha')}}
                  </div>
                @endif
                </div>
                <div class="col-12">
                  <button type="submit" class="btn btn-sm btn-primary">Editar</button>
                  <a class="btn btn-sm btn-danger" href="{{ route('usuarios') }}">Voltar</a>
                </div>
              </form>
            
        </div>
  </div>
@endsection