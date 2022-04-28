@extends('header')
@section('content')
    Id: <b>{{$client->id}}</b> &nbsp;&nbsp;
    Nome: <b>{{$client->nome}}</b> &nbsp;&nbsp;
    Tipo: <b>{{$client->tipo}}</b> &nbsp;&nbsp;
    @if($client->tipo == 'Pessoa Física')
        CPF:
    @else
        CNPJ:
    @endif
    <b>{{$client->cpf}}</b>
    <button onclick="createOrder()" type="button" class="btn btn-sm btn-sm btn-primary" style="float:right">
        Adicionar Ordem de Serviço
    </button>
    <br>
    Email: <b>{{$client->email}}</b> &nbsp;&nbsp;
    Telefone 1: <b>{{$client->telefone}}</b> &nbsp;&nbsp;
    Telefone 2: <b>{{$client->telefone2}}</b> &nbsp;&nbsp;
    Data de cadastro: <b>{{$client->data}}</b>
    <br>
    Endereço: <b>{{$client->endereco}}</b>
    <br><br>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Descrição</th>
            <th scope="col">Tipo</th>
            <th scope="col">Técnico</th>
            <th scope="col">Valor</th>
            <th scope="col">Situação</th>
            <th scope="col">Dt. Entrada</th>
            <th scope="col">Dt. Retirada</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{$order->id_ordem}}</td>
            <td>{{$order->obs}}</td>
            <td>{{$order->tipo}}</td>
            <td>{{$order->tecnico}}</td>
            <td>{{'R$ '.number_format($order->preco, 2, ',', '.') }}</td>
            <td>
                @if($order->data_retirada == null)
                    <a href="#" onclick="situacao({{$order}})">
                        @if($order->situacao == null)
                            Inserir
                        @else
                            {{$order->situacao}}
                        @endif
                    </a>
                @else
                    Entregue
                @endif
            </td>
            <td>{{$order->data_entrada}}</td>
            <td>{{$order->data_retirada}}</td>
            <td>
                @if($order->data_retirada == null)
                    <a onclick="editOrder({{$order}})" style="color:#788288;" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-pen"></i></a>
                    <a onclick="removeOrder({{$order->id_ordem}})" style="color:#788288;" data-toggle="tooltip" data-placement="top" title="Retirar"><i class="fas fa-sign-out-alt"></i></a>
                    <a onclick="deleteOrder({{$order->id_ordem}})" style="color:#788288;" data-toggle="tooltip" data-placement="top" title="Excluir"><i class="fas fa-trash-alt"></i></a>
                @endif
                <a href="/print/{{$order->id_ordem}}" target="_blank" style="color:#788288;" data-toggle="tooltip" data-placement="top" title="Imprimir"><i class="fas fa-print"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<form id="formOrderRemove" action="/orderRemove" method="post">
    @csrf
    <input type="hidden" name="id_ordem" id="id_ordem" value="">
</form>
<form id="formOrderDelete" action="/orderDelete" method="post">
    @csrf
    <input type="hidden" name="id_ordem_delete" id="id_ordem_delete" value="">
</form>
<!-- Modal -->
<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderModalLabel">Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/order" id="formOrder" method="post">
                    @csrf
                    <input type="hidden" id="id_ordem_edit" name="id_ordem_edit" value="">
                    <input type="hidden" id="id_cliente" name="id_cliente" value="{{$client->id}}">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="obs">Descrição:</label>
                            <textarea class="form-control form-control-sm" id="obs" name="obs" value=""></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="tipo">Tipo:</label>
                            <select class="form-control form-control-sm" name="tipo" id="tipo">
                                <option value="Ordem de Serviço">Ordem de Serviço</option>
                                <option value="Ordem de Venda">Ordem de Venda</option>
                                <option value="Orçamento" selected>Orçamento</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="tecnico">Técnico:</label>
                            <select class="form-control form-control-sm" name="tecnico" id="tecnico">
                                <option>Selecione o técnico responsável</option>
                                @foreach($employeds as $employed)
                                    <option value="{{$employed->nome}}">{{$employed->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="preco">Valor:</label>
                            <input type="text" class="form-control form-control-sm" id="preco" name="preco" value=""></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-sm btn-primary" onclick="sumbitForm()">Cadastrar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="orderSituacaoModal" tabindex="-1" role="dialog" aria-labelledby="orderSituacaoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderSituacaoModalLabel">Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/orderSituacao" id="formOrderSituacao" method="post">
                    @csrf
                    <input type="hidden" name="id_ordem_situacao" id="id_ordem_situacao" value="">
                    <label for="situacao">Situação</label>
                    <select name="situacao" id="situacao" class="form-control form-control-sm">
    					<option value="" selected>Selecione a Situação</option>
                        <option value="Em análise">Em análise</option>
    					<option value="Aguardando peça">Aguardando peça</option>
    					<option value="Sem conserto">Sem conserto</option>
    					<option value="Pronto">Pronto</option>
                    </select>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-sm btn-primary" onclick="sumbitSituacaoForm()">Cadastrar</button>
            </div>
        </div>
    </div>
</div>
<script>
    $("#preco").maskMoney({prefix:'R$ ', allowNegative: false, thousands:'.', decimal:',', affixesStay: false})
    function deleteOrder(id){
        $("#id_ordem_delete").val(id);
        var response = confirm('Deseja realmente excluir a OS '+id+'?');
        if (response == true) {
            document.getElementById("formOrderDelete").submit();
        }
    }
    function sumbitSituacaoForm(){
        document.getElementById("formOrderSituacao").submit();
    }
    function sumbitForm(){
        document.getElementById("formOrder").submit();
    }
    function removeOrder(id){
        $("#id_ordem").val(id);
        var response = confirm('Deseja retirar os produtos da OS '+id+'?');
        if (response == true) {
            document.getElementById("formOrderRemove").submit();
        }
    }
    function situacao(order){
        console.log(order);
        $("#id_ordem_situacao").val(order.id_ordem);
        if (order.situacao != null) {
            $("#situacao").val(order.situacao);
        }else {
            $("#situacao").val("");
        }
        $("#orderSituacaoModal").modal();

    }
    function createOrder(){
        $("#id_ordem_edit").val('');
        $("#obs").val('');
        $("#tipo").val('');
        $("#tecnico").val('');
        $("#preco").val('');
        $("#orderModal").modal();
    }
    function editOrder(order){
        console.log(order);
        $("#id_ordem_edit").val(order.id_ordem);
        $("#obs").val(order.obs);
        $("#tipo").val(order.tipo);
        $("#tecnico").val(order.tecnico);
        $("#preco").val(numberToReal(order.preco));
        $("#orderModal").modal();
    }
</script>
@endsection
