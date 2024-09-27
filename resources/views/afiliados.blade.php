@extends('layouts.app', ["current" => "afiliados"])

@section('body')
<div class="card border border-0 shadow p-3 mb-5 bg-body-tertiary rounded">
    <div class="card-header border-0">
        Lista Afiliados
    </div>
    <div class="card-body">
@if(count($afiliados) > 0)
        <table class="table table-bordered table-hover" id="tableAfiliados">
            <thead class="table-light">
                <tr>
                  <th>#</th>
                  <th>Nome</th>
                  <th>CPF</th>
                  <th>Dt Nasc</th>
                  <th>Email</th>
                  <th>Tel</th>
                  <th>End</th>
                  <th>Estado</th>
                  <th>Cidade</th>
                </tr>
              </thead>
              <tbody>
                @foreach($afiliados as $afiliado)
                    <tr>
                        <td>{{ $afiliado->id }}</td>
                        <td>{{ $afiliado->nome }}</td>
                        <td>{{ $afiliado->cpf }}</td>
                        <td>{{ \Carbon\Carbon::parse($afiliado->dataNascimento)->format('d/m/Y') }}</td>
                        <td>{{ $afiliado->email }}</td>
                        <td>{{ $afiliado->telefone }}</td>
                        <td>{{ $afiliado->endereco }}</td>
                        <td>{{ $afiliado->estado }}</td>
                        <td>{{ $afiliado->cidade }}</td>
                        <td>
                            <a href="/afiliados/editar/{{ $afiliado->id }}" class="btn btn-sm btn-warning">Editar</a>
                            <a href="/afiliados/deletar/{{ $afiliado->id }}" class="btn btn-sm btn-danger">Deletar</a>
                        </td>
                    </tr>
                @endforeach
              </tbody>
        </table>
@endif
    </div>
    <div class="col-12">
        <button onclick="cadastrarAfiliado()" type="button" class="btn btn-sm btn-primary" role="button">Cadastrar</button>
    </div>
</div>


<div class="modal fade modal-lg" id="modalCadastrarAfiliados" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Cadastrar Afiliado</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="afiliadoId" class="form-control">
            <form action="/afiliados" method="POST" class="form-horizontal row g-3" id="formCadastroAfiliado">
                @csrf
                <div class="col-md-4">
                  <label for="afiliadoEmail" class="form-label">Email</label>
                  <input placeholder="Digite seu email" type="email" class="form-control" id="afiliadoEmail" name="afiliadoEmail">
                </div>
                <div class="col-md-4">
                  <label for="afiliadoNome" class="form-label">Nome</label>
                  <input placeholder="Digite seu nome" type="text" class="form-control" id="afiliadoNome" name="afiliadoNome">
                </div>
                <div class="col-md-4">
                  <label for="afiliadoCPF" class="form-label">CPF</label>
                  <input placeholder="Digite seu cpf" name="afiliadoCPF" type="text" class="form-control" id="afiliadoCPF">
                </div>
                <div class="col-md-4">
                    <label for="afiliadoDtNasc" class="form-label">Data Nascimento</label>
                    <input placeholder="Data" name="afiliadoDtNasc" type="date" class="form-control" id="afiliadoDtNasc">
                  </div>
                  <div class="col-md-4">
                    <label for="afiliadoTel" class="form-label">Telefone</label>
                    <input placeholder="Digite seu telefone" name="afiliadoTel" type="tel" class="form-control" id="afiliadoTel">
                  </div>
                  <div class="col-md-4">
                    <label for="afiliadoEnd" class="form-label">Endereço</label>
                    <input placeholder="Digite seu endereço" name="afiliadoEnd" type="text" class="form-control" id="afiliadoEnd">
                  </div>
                  <div class="col-md-6">
                    <label for="afiliadoEstado" class="form-label">Estado</label>
                    <select name="afiliadoEstado" class="form-select" id="afiliadoEstado">
                        <option selected disabled>Selecione o Estado</option>
                      </select>
                  </div>
                  <div class="col-md-6">
                    <label for="afiliadoCidade" class="form-label">Cidade</label>
                    <select name="afiliadoCidade" class="form-select" id="afiliadoCidade" disabled>
                        <option selected disabled>Selecione a Cidade</option>
                    </select>
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
        
        function cadastrarAfiliado()
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
    <script>
        async function carregarEstados() {
            try {
                const response = await fetch('https://servicodados.ibge.gov.br/api/v1/localidades/estados/');
                const estados = await response.json();

                const select = document.getElementById('afiliadoEstado');

                estados.forEach(estado => {
                    const option = document.createElement('option');
                    option.value = estado.sigla;
                    option.textContent = estado.nome;
                    select.appendChild(option);
                });
            } catch (error) {
                console.error('Erro ao carregar estados:', error);
            }
        }
        carregarEstados();
    </script> 
    <script>
        async function carregarDistritos(uf) {
            try {
                const response = await fetch(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${uf}/distritos`);
                const distritos = await response.json();

                const select = document.getElementById('afiliadoCidade');
                select.innerHTML = '<option value="">Selecione uma cidade</option>'; 
                select.disabled = false;

                distritos.forEach(distrito => {
                    const option = document.createElement('option');
                    option.value = distrito.nome;
                    option.textContent = distrito.nome;
                    select.appendChild(option);
                });
            } catch (error) {
                console.error('Erro ao carregar cidades:', error);
            }
        }

        document.getElementById('afiliadoEstado').addEventListener('change', (event) => {
            const uf = event.target.value;
            if (uf) {
                carregarDistritos(uf);
            } else {
                document.getElementById('afiliadoCidade').innerHTML = '<option value="">Selecione uma cidade</option>';
                document.getElementById('afiliadoCidade').disabled = true;
            }
        });
    </script>
    <script>
        function montarLinha(param){
            var linha = "<tr>"+
                "<td>"+param.id+"</td>"+
                "<td>"+param.nome+"</td>"+
                "<td>"+param.cpf+"</td>"+
                "<td>"+new Date(param.dataNascimento).toLocaleDateString('pt-br')+"</td>"+
                "<td>"+param.email+"</td>"+
                "<td>"+param.telefone+"</td>"+
                "<td>"+param.estado+"</td>"+
                "<td>"+param.cidade+"</td>"+
                "<td>"+
                    "<button class='btn btn-sm btn-warning'>Editar</button>"+
                    "&nbsp;&nbsp;&nbsp;<button class='btn btn-sm btn-danger'>Apagar</button>"+
                "</td>"+
                "</tr>";
            return linha;
        }

        function carregarAfiliados()
        {
            $.getJSON('/api/afiliados', function(afiliados){
                for(var i = 0; i < afiliados.length; i++){
                    linha = montarLinha(afiliados[i]);
                    $('#tableAfiliados>tbody').append(linha);
                }
            });
        }

        // function criarAfiliado(){
        //     afiliado = {
        //         id_perfil: 2,
        //         email: $('#afiliadoEmail').val(),
        //         nome: $('#afiliadoNome').val(),
        //         cpf: $('#afiliadoCPF').val(),
        //         dataNascimento: $('#afiliadoDtNasc').val(),
        //         telefone: $('#afiliadoTel').val(),
        //         endereco: $('#afiliadoEnd').val(),
        //         cidade: $('#afiliadoCidade').val(),
        //         estado: $('#afiliadoEstado').val()
        //     };
        //     // console.log(afiliado);
        //     $.post('/api/afiliados', afiliado, function(data){
        //         console.log(data);
        //     });
        // }

        // $('#formCadastroAfiliado').submit(function(event){
        //     event.preventDefault();
        //     criarAfiliado();
        //     // $('#modalCadastrarAfiliados').modal('hide');
        // });
    </script>
    <script>
    $(function(){
        carregarAfiliados();
    })
    </script>
@endsection