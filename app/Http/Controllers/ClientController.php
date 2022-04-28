<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $clientes = new Cliente();
        if ($request->has('search')) {
            $clientes = $clientes->where($request->input('search'), 'like', '%'.$request->input('inputSeach').'%');
        }
        $clientes = $clientes->whereNull('data_exclusao')
        ->orderBy('id', 'desc')->paginate(15)->withQueryString();
        return view('cliente.index', ['clientes' => $clientes]);
    }

    public function store(Request $request)
    {
        if ($request->input('id') != null) {
            $client = Cliente::find($request->input('id'));
        }else {
            $client = new Cliente;
            $client->data = date('d/m/Y');
        }
        $client = $client->fill($request->all());

        if (!$client->save()) {
            dd('erro!');
        }
        return back()->with('success', 'Cliente cadastrado com sucesso!');
        dd($client);
    }

    public function destroy($id)
    {
        Cliente::where('id', $id)->update(['data_exclusao' => date('Y-m-d')]);
        return back()->with('error', 'Cliente deletado com sucesso!');
    }
}
