@extends('header')
@section('content')
<form action="client" method="get">
    <div class="form-row">
        <div class="form-group col-md-2">
            <select class="custom-select custom-select-sm" id="search" name="search">
                <option value="id">Código</option>
                <option value="nome" selected>Nome</option>
            </select>
        </div>
        <div class="form-group col-md-7">
            <input type="text" class="form-control form-control-sm" id="inputSeach" name="inputSeach" placeholder="Pesquisar" value="{{ app('request')->input('inputSeach') }}">
        </div>
        <div class="form-group col-md-1">
            <span class="input-group-btn">
                <button type="submit" class="btn btn-default btn-circle btn-sm">
                    <span class="glyphicon glyphicon-search"><i class="fas fa-search"></i></span>
                </button>
            </span>
        </div>
        <div class="form-group col-md-2">
            <button onclick="createClient()" type="button" class="btn btn-sm btn-primary">Adicionar Cliente</button>
        </div>
    </div>
</form>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Telefone</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($clientes as $cliente)
        <tr>
            <th scope="row">{{$cliente->id}}</th>
            <td>{{$cliente->nome}}</td>
            <td>{{$cliente->telefone}}</td>
            <td>
                <a href="order/{{ $cliente->id }}" style="color:#788288;" data-toggle="tooltip" data-placement="top" title="Ordens de Serviço"><i class="fas fa-file"></i></a>
                <a onclick="editClient({{ $cliente }})" style="color:#788288;" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-pen"></i></a>
                <a onclick="deleteClient({{ $cliente->id }}, '{{ $cliente->nome }}')" style="color:#788288;" data-toggle="tooltip" data-placement="top" title="Excluir"><i class="fas fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $clientes->links() }}
<form id="formClientDelete" action="client" method="post">
    @csrf
    <input type="hidden" name="_method" value="delete" />
</form>
<!-- Modal -->
<div class="modal fade" id="clientModal" tabindex="-1" role="dialog" aria-labelledby="clientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="clientModalLabel">Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="client" id="formClient" method="post">
                    @csrf
                    <input type="hidden" id="id" name="id" value="">
                    <div class="form-row">
                        <div class="form-group col-md-9">
                            <label for="nome">Nome Completo:</label>
                            <input type="text" class="form-control form-control-sm" id="nome" name="nome" value="">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="tipo">Tipo:</label>
                            <select class="form-control form-control-sm" name="tipo" id="tipo" onchange="tipoChange(this)">
                                <option value="Pessoa Física" selected>Pessoa Física</option>
                                <option value="Pessoa Jurídica">Pessoa Jurídica</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="telefone">Celular:</label>
                            <input type="text" class="form-control form-control-sm" id="telefone" name="telefone" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="telefone2">Tel. Fixo:</label>
                            <input type="text" class="form-control form-control-sm" id="telefone2" name="telefone2" value="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="cpf" id="labelCpf">CPF:</label>
                            <input type="text" class="form-control form-control-sm" id="cpf" name="cpf" value="" style="display:block">
                            <!-- <input type="text" class="form-control form-control-sm" id="cpf" name="cpf" value="" style="display:none"> -->
                        </div>
                        <div class="form-group col-md-7">
                            <label for="email">E-mail:</label>
                            <input type="text" class="form-control form-control-sm" id="email" name="email" value="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="endereco">Endereço:</label>
                            <textarea type="text" class="form-control form-control-sm" id="endereco" name="endereco" value=""></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="sumbitForm()">Cadastrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#telefone').mask('(00) 00000-0000');
    $('#telefone2').mask('(00) 0000-0000');
    function tipoChange(element){
        if (element.value == 'Pessoa Física') {
            $('#cpf').mask('000.000.000-00');
            $("#labelCpf").empty().append('CPF:')
        }else {
            $('#cpf').mask('00.000.000/0000-00');
            $("#labelCpf").empty().append('CNPJ:')
        }
    }
    function sumbitForm(){
        document.getElementById("formClient").submit();
    }
    function deleteClient(id, name){
        var response = confirm('Deseja realmente excluir o cliente '+id+' - '+name+'?');
        if (response == true) {
            document.getElementById("formClientDelete").action = '/client/'+id;
            document.getElementById("formClientDelete").submit();
        }
    }
    function createClient(){
        $('#cpf').mask('000.000.000-00');
        if ($("#id").val()) {
            $("#id").val('');
            $("#nome").val('');
            $("#tipo").val('');
            $("#telefone").val('');
            $("#telefone2").val('');
            $("#cpf").val('');
            $("#email").val('');
            $("#endereco").val('');
            $("#clientModal").modal();
        }
        $("#clientModal").modal();
    }
    function editClient(client){
        if (client.tipo == 'Pessoa Física') {
            $('#cpf').mask('000.000.000-00');
            $("#labelCpf").empty().append('CPF:')
        }else {
            $('#cpf').mask('00.000.000/0000-00');
            $("#labelCpf").empty().append('CNPJ:')
        }
        $("#id").val(client.id);
        $("#nome").val(client.nome);
        $("#tipo").val(client.tipo);
        $("#telefone").val(client.telefone);
        $("#telefone2").val(client.telefone2);
        $("#cpf").val(client.cpf);
        $("#email").val(client.email);
        $("#endereco").val(client.endereco);
        $("#clientModal").modal();
    }
</script>
@endsection
