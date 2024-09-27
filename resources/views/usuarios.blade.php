@extends('layouts.app', ["current" => "usuarios"])

@section('body')
<div class="card border border-0 shadow p-3 mb-5 bg-body-tertiary rounded">
    <div class="card-header border-0">
        Lista usuários
    </div>
    <div class="card-body">
@if(count($users) > 0)
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                  <th>#</th>
                  <th>Nome</th>
                  <th>Email</th>
                  <th>Senha</th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user-> id }}</td>
                        <td>{{ $user-> nome }}</td>
                        <td>{{ $user-> email }}</td>
                        <td>{{ $user-> senha }}</td>
                        <td>
                            <a href="/usuarios/editar/{{$user->id}}" class="btn btn-sm btn-warning">Editar</a>
                            <a href="/usuarios/deletar/{{$user->id}}" class="btn btn-sm btn-danger">Deletar</a>
                        </td>
                    </tr>
                @endforeach
              </tbody>
        </table>
@endif
    </div>
    <div class="col-12">
        <a href="/usuarios/novo" class="btn btn-sm btn-primary" role="button">Cadastrar</a>
    </div>
</div>
@endsection