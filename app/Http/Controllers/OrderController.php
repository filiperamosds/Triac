<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servico;
use App\Models\Cliente;
use App\Models\Funcionario;

class OrderController extends Controller
{
    public function number($number){
        $number = str_replace(".", "", $number);
        $number = str_replace(",", ".", $number);
        return floatval($number);
    }

    public function index($client){
        $orders = Servico::where('id_cliente', $client)->whereNull('data_exclusao')->get();
        $client = Cliente::find($client);
        $employeds = Funcionario::whereNull('data_exclusao')->get();
        // dd($employeds);
        return view('servico.index', [
            'orders' => $orders,
            'client' => $client,
            'employeds' => $employeds]);
    }

    public function list(Request $request){
        $orders = Servico::with('cliente')->whereNull('data_exclusao');
        if ($request->has('search')) {
            $orders = $orders->where($request->input('search'), 'like', '%'.$request->input('inputSeach').'%');
        }
        $orders = $orders->orderBy('id_ordem', 'desc')->paginate(15)->withQueryString();
        return view('servico.lista', ['orders' => $orders]);
    }

    public function remove(Request $request){
        $order = Servico::find($request->input('id_ordem'));
        $order->data_retirada = date('d/m/Y');
        if (!$order->save())
            return back()->with('error', $this->response->errorInternal());

        return back()->with('success', 'Ordem retirada com sucesso!');
    }

    public function situacao(Request $request){
        $order = Servico::find($request->input('id_ordem_situacao'));
        $order->situacao = $request->input('situacao');
        if (!$order->save())
            return back()->with('error', $this->response->errorInternal());

        return back()->with('success', 'Situação editada com sucesso!');
    }

    public function store(Request $request){
        if ($request->input('id_ordem_edit') != null) {
            $order = Servico::find($request->input('id_ordem_edit'));
        }else {
            $order = new Servico;
            $order->data_entrada = date('d/m/Y');
        }
        $order = $order->fill($request->all());
        $order->preco = $this->number($request->input('preco'));
        if (!$order->save())
            return back()->with('error', $this->response->errorInternal());

        return back()->with('success', 'Cliente cadastrado com sucesso!');
    }

    public function destroy(Request $request){
        $order = Servico::find($request->input('id_ordem_delete'));
        $order->data_exclusao = date('Y-m-d');

        if (!$order->save())
            return back()->with('error', $this->response->errorInternal());

        return back()->with('success', 'Ordem excluida com sucesso!');
    }

    public function print($id){
        $order = Servico::find($id);
        $client = Cliente::find($order->id_cliente);
        return \PDF::loadView('print.order', ['order' => $order, 'client' => $client])->stream();
        // return $pdf->download('invoice.pdf');
    }
}
