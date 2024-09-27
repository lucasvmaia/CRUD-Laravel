@extends('layouts.app', ["current" => "home"])
@section('body')
    <div class="shadow p-3 mb-5 bg-body-tertiary rounded jumbotron bg-light border border-light container text-center">
        <div class="row">
            <div class="col-sm-4 mb-3 mb-sm-0">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Usuários</h5>
                    <br><br>
                    <a href="/usuarios" class="btn btn-primary">➡</a>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 mb-3 mb-sm-0">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Afiliados</h5>
                    <br><br>
                    <a href="/afiliados" class="btn btn-primary">➡</a>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 mb-3 mb-sm-0">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Comissões</h5>
                    <br><br>
                    <a href="/comissoes" class="btn btn-primary">➡</a>
                  </div>
                </div>
              </div>
        </div>
    </div>
@endsection