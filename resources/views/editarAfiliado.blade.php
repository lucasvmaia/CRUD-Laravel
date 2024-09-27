@extends('layouts.app', ["current" => "afiliados"])

@section('body')

<div class="card" id="cardEditarAfiliados">
        <div class="card-header">
          <h1 class="card-title fs-5">Editar Afiliado {{ $afiliados->id }}</h1>
        </div>
        <div class="card-body">
            <input type="hidden" id="afiliadoId" class="form-control">
            <form action="/afiliados/{{$afiliados->id}}" method="POST" class="form-horizontal row g-3" id="formCadastroAfiliado">
                @csrf
                <div class="col-md-4">
                  <label for="afiliadoEmail" class="form-label">Email</label>
                  <input value="{{ $afiliados->email }}" placeholder="Digite seu email" type="email" class="form-control" id="afiliadoEmail" name="afiliadoEmail">
                </div>
                <div class="col-md-4">
                  <label for="afiliadoNome" class="form-label">Nome</label>
                  <input value="{{ $afiliados->nome }}" placeholder="Digite seu nome" type="text" class="form-control" id="afiliadoNome" name="afiliadoNome">
                </div>
                <div class="col-md-4">
                  <label for="afiliadoCPF" class="form-label">CPF</label>
                  <input value="{{ $afiliados->cpf }}" placeholder="Digite seu cpf" name="afiliadoCPF" type="text" class="form-control" id="afiliadoCPF">
                </div>
                <div class="col-md-4">
                    <label for="afiliadoDtNasc" class="form-label">Data Nascimento</label>
                    <input value="{{ $afiliados->dataNascimento }}" placeholder="Data" name="afiliadoDtNasc" type="date" class="form-control" id="afiliadoDtNasc">
                  </div>
                  <div class="col-md-4">
                    <label for="afiliadoTel" class="form-label">Telefone</label>
                    <input value="{{ $afiliados->telefone }}" placeholder="Digite seu telefone" name="afiliadoTel" type="tel" class="form-control" id="afiliadoTel">
                  </div>
                  <div class="col-md-4">
                    <label for="afiliadoEnd" class="form-label">Endereço</label>
                    <input value="{{ $afiliados->endereco }}" placeholder="Digite seu endereço" name="afiliadoEnd" type="text" class="form-control" id="afiliadoEnd">
                  </div>
                  <div class="col-md-6">
                    <label for="afiliadoEstado" class="form-label">Estado</label>
                    <select name="afiliadoEstado" class="form-select" id="afiliadoEstado">
                        <option name="afiliadoEstado" value="{{ $afiliados->estado }}" selected disabled>{{ $afiliados->estado }}</option>
                      </select>
                  </div>
                  <div class="col-md-6">
                    <label for="afiliadoCidade" class="form-label">Cidade</label>
                    <select name="afiliadoCidade" class="form-select" id="afiliadoCidade" disabled>
                        <option name="afiliadoCidade" value="{{$afiliados->cidade}}" selected disabled>{{ $afiliados->cidade }}</option>
                    </select>
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-sm btn-primary">Editar</button>
                    <a class="btn btn-sm btn-danger" href="{{ route('afiliados') }}">Voltar</a>
                </div>
              </form>
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