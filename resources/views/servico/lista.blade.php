@extends('header')
@section('content')
<form action="orderList" method="get">
    <div class="form-row">
        <div class="form-group col-md-3">
            <select class="custom-select custom-select-sm" id="search" name="search">
                <option value="id_ordem" selected>Nº Ordem de Serviço</option>
                <option value="obs">Descrição</option>
            </select>
        </div>
        <div class="form-group col-md-8">
            <input type="text" class="form-control form-control-sm" id="inputSeach" name="inputSeach" placeholder="Pesquisar" value="{{ app('request')->input('inputSeach') }}">
        </div>
        <div class="form-group col-md-1">
            <span class="input-group-btn">
                <button type="submit" class="btn btn-default btn-circle btn-sm">
                    <span class="glyphicon glyphicon-search"><i class="fas fa-search"></i></span>
                </button>
            </span>
        </div>
    </div>
</form>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Descrição</th>
            <th scope="col">Data</th>
            <th scope="col">Cliente</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr onclick="order({{$order->id_cliente}})" class="pointer">
            <th scope="row">{{$order->id_ordem}}</th>
            <td>{{$order->obs}}</td>
            <td>{{$order->data_entrada}}</td>
            <td>{{$order->cliente->nome}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
{{$orders->links()}}
<form id="formOrderRedirect" action="client" method="get">
    @csrf
</form>
<script>
    function order(id_cliente){
        document.getElementById("formOrderRedirect").action = '/order/'+id_cliente;
        document.getElementById("formOrderRedirect").submit();
    }
</script>
@endsection
