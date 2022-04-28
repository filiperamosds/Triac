<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
        .container{
            width: 100%;
            height: 40%;
        }
        .header{
            text-align: center;
            width: 100%;
            border-style: solid;
        }
        .body{
            width: 100%;
        }
        .tableClient{
            width: 100%
        }
        .tableOrder{
            width: 100%
        }
        .tableAss{
            width: 100%;
        }
        .ass{
            text-align: center;
        }
        .lineAss{
            border-bottom: 2px solid black
        }
        hr{
            border-top: 1px dashed black;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Eletrônica TRIAC</h1>
            <h4> Telefone:3483-0286 Endereço:ES.12 loja 3A Cond.Mini-Chácaras-Sobradinho II</h4>
        </div>
        <div class="body">
            <table class="tableClient">
                <tr>
                    <td>Nome: <b>{{$client->nome}}</b></td>
                    <td>
                        @if($client->tipo == 'Pessoa Física')
                            CPF:
                        @else
                            CNPJ:
                        @endif
                        <b>{{$client->cpf}}</b>
                    </td>
                </tr>
                <tr>
                    <td>Email: <b>{{$client->email}}</b></td>
                    <td>Telefone: <b>{{$client->telefone}}</b></td>
                </tr>
                <tr>
                    <td colspan="2">Endereço: <b>{{$client->endereco}}</b></td>
                </tr>
            </table>
            <br>
            <table class="tableOrder">
                <tr>
                    <td>Nº: <b>{{$order->id_ordem}}</b></td>
                    <td><b>{{$order->tipo}}</b></td>
                    <td>Valor: <b>{{ 'R$ '.number_format($order->preco, 2, ',', '.') }}</b></td>
                    <td>Data: <b>{{$order->data_entrada}}</b></td>
                    @if($order->data_retirada != null)
                        <td>Retirada: <b>{{$order->data_retirada}}</b></td>
                    @endif
                </tr>
                <tr>
                    @if($order->data_retirada == null)
                        <td colspan="4">Descrição: <b>{{$order->obs}}</b></td>
                    @else
                        <td colspan="5">Descrição: <b>{{$order->obs}}</b></td>
                    @endif
                </tr>
            </table>
        </div>
        <br><br>
        <table class="tableAss">
            <tr>
                <td class="lineAss"></td>
                <td style="width:10%"></td>
                <td class="lineAss"></td>
            </tr>
            <tr>
                <td class="ass">Assinatura Cliente</td>
                <td></td>
                <td class="ass">Assinatura Loja</td>
            </tr>
        </table>
        <br>
        @if($order->tipo != 'Ordem de Venda')
            @if($order->data_retirada == null)
                *obs: Os aparelhos nao retirados após 90 dias e prévio aviso, serão vendidos pelo valor do orçamento para cobrir os custos do conserto.
            @else
                *obs: Garantia valida somente com a apresentação deste carimbado, e equipamento com selo intacto.
            @endif
        @endif
    </div>
    <hr>
    <div class="container">
        <div class="header">
            <h1>Eletrônica TRIAC</h1>
            <h4> Telefone:3483-0286 Endereço:ES.12 loja 3A Cond.Mini-Chácaras-Sobradinho II</h4>
        </div>
        <div class="body">
            <table class="tableClient">
                <tr>
                    <td>Nome: <b>{{$client->nome}}</b></td>
                    <td>
                        @if($client->tipo == 'Pessoa Física')
                            CPF:
                        @else
                            CNPJ:
                        @endif
                        <b>{{$client->cpf}}</b>
                    </td>
                </tr>
                <tr>
                    <td>Email: <b>{{$client->email}}</b></td>
                    <td>Telefone: <b>{{$client->telefone}}</b></td>
                </tr>
                <tr>
                    <td colspan="2">Endereço: <b>{{$client->endereco}}</b></td>
                </tr>
            </table>
            <br>
            <table class="tableOrder">
                <tr>
                    <td>Nº: <b>{{$order->id_ordem}}</b></td>
                    <td><b>{{$order->tipo}}</b></td>
                    <td>Valor: <b>{{ 'R$ '.number_format($order->preco, 2, ',', '.') }}</b></td>
                    <td>Data: <b>{{$order->data_entrada}}</b></td>
                    @if($order->data_retirada != null)
                        <td>Retirada: <b>{{$order->data_retirada}}</b></td>
                    @endif
                </tr>
                <tr>
                    @if($order->data_retirada == null)
                        <td colspan="4">Descrição: <b>{{$order->obs}}</b></td>
                    @else
                        <td colspan="5">Descrição: <b>{{$order->obs}}</b></td>
                    @endif
                </tr>
            </table>
        </div>
        <br><br>
        <table class="tableAss">
            <tr>
                <td class="lineAss"></td>
                <td style="width:10%"></td>
                <td class="lineAss"></td>
            </tr>
            <tr>
                <td class="ass">Assinatura Cliente</td>
                <td></td>
                <td class="ass">Assinatura Loja</td>
            </tr>
        </table>
        <br>
        @if($order->data_retirada == null)
            *obs: Os aparelhos nao retirados após 90 dias e prévio aviso, serão vendidos pelo valor do orçamento para cobrir os custos do conserto.
        @else
            *obs: Garantia valida somente com a apresentação deste carimbado, e equipamento com selo intacto.
        @endif
    </div>
</body>
</html>
