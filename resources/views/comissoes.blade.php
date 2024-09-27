@extends('layouts.app', ["current" => "comissoes"])

@section('body')
<div class="card border border-0 shadow p-3 mb-5 bg-body-tertiary rounded">
    <div class="card-header border-0">
        Lista Comissões
    </div>
    <div class="card-body">
@if(count($comissoes) > 0)
        <table class="table table-bordered table-hover" id="tableComissoes">
            <thead class="table-light">
                <tr>
                  <th>#</th>
                  <th>Afiliado (CPF)</th>
                  <th>Valor</th>
                  <th>Data</th>
                </tr>
              </thead>
              <tbody>
                @foreach($comissoes as $comissao)
                    <tr>
                        <td>{{ $comissao->id }}</td>
                        <td>{{ $comissao->afiliado }}</td>
                        <td>{{ $comissao->valor }}</td>
                        <td>{{ \Carbon\Carbon::parse($comissao->data)->format('d/m/Y') }}</td>
                        <td>
                            <a href="/comissoes/editar/{{ $comissao->id }}" class="btn btn-sm btn-warning">Editar</a>
                            <a href="/comissoes/deletar/{{ $comissao->id }}" class="btn btn-sm btn-danger">Deletar</a>
                        </td>
                    </tr>
                @endforeach
              </tbody>
        </table>
@endif
    </div>
    <div class="col-12">
        <button onclick="cadastrarComissao()" type="button" class="btn btn-sm btn-primary" role="button">Cadastrar</button>
    </div>
</div>


<div class="modal fade modal-lg" id="modalCadastrarComissao" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Cadastrar Comissao</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="comissaoId" class="form-control">
            <form action="/comissoes" method="POST" class="form-horizontal row g-3" id="formCadastroComissao">
                @csrf
                <div class="col-md-6">
                  <label for="comissaoValor" class="form-label">Valor</label>
                  <input step=".01" placeholder="Digite o valor" type="number" class="form-control {{ $errors->has('comissaoValor') ? 'is-invalid' : ''}}" id="comissaoValor" name="comissaoValor">
                  @if($errors->has('comissaoValor'))
                  <div class="invalid-feedback">
                    {{ $errors->first('comissaoValor')}}
                  </div>
                @endif
                </div>
                <div class="col-md-6">
                  <label for="afiliadoCPF" class="form-label">Afiliado (CPF)</label>
                  <input placeholder="Digite seu nome" type="text" class="form-control {{ $errors->has('afiliadoCPF') ? 'is-invalid' : ''}}" id="afiliadoCPF" name="afiliadoCPF">
                  @if($errors->has('afiliadoCPF'))
                  <div class="invalid-feedback">
                    {{ $errors->first('afiliadoCPF')}}
                  </div>
                @endif
                </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary">Cadastrar</button>
                    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Fechar</button>
                </div>
              </form>
        </div>
      </div>
    </div>
  </div>


@endsection


@section('javascript')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        
        function cadastrarComissao()
        {   
            $('#afiliadoId').val('');
            $('#afiliadoNome').val('');
            $('#afiliadoEmail').val('');
            $('#afiliadoCPF').val('');
            $('#afiliadoDtNasc').val('');
            $('#afiliadoTel').val('');
            $('#afiliadoEnd').val('');
            $('#afiliadoCidade').val('');
            $('#afiliadoCidade').prop('disabled', true);
            $('#afiliadoEstado').val('');
            $('.modal').modal('show');
        }
    </script>  
@endsection