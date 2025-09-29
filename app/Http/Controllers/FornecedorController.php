<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;

class FornecedorController extends Controller
{
    // Listagem com busca e paginação
    public function index(Request $request)
    {
        $busca = $request->input('busca');
        $query = Fornecedor::query();

        if($busca) {
            $query->where('nome', 'like', "%{$busca}%")
                  ->orWhere('email', 'like', "%{$busca}%")
                  ->orWhere('site', 'like', "%{$busca}%")
                  ->orWhere('uf', 'like', "%{$busca}%");
        }

        $registros = $query->orderBy('nome')->paginate(10);

        return view('fornecedor.index', compact('registros'));
    }

    // Salvar novo fornecedor
    public function salvar(Request $request)
    {
        $request->validate([
            'nome' => 'required|max:255',
            'email' => 'nullable|email',
            'site' => 'nullable|string|max:255',
            'uf' => 'nullable|string|max:2'
        ]);

        Fornecedor::create($request->all());

        return redirect()->route('fornecedor.index')->with('sucesso', 'Fornecedor cadastrado com sucesso!');
    }

    // Salvar fornecedor editado
    public function salvarEditado(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:fornecedores,id',
            'nome' => 'required|max:255',
            'email' => 'nullable|email',
            'site' => 'nullable|string|max:255',
            'uf' => 'nullable|string|max:2'
        ]);

        $fornecedor = Fornecedor::findOrFail($request->id);
        $fornecedor->update($request->only('nome','email','site','uf'));

        return redirect()->route('fornecedor.index')->with('sucesso', 'Fornecedor atualizado com sucesso!');
    }

    // Excluir fornecedor
    public function excluir(Request $request)
    {
        $request->validate(['id' => 'required|exists:fornecedores,id']);
        $fornecedor = Fornecedor::findOrFail($request->id);
        $fornecedor->delete();

        return redirect()->route('fornecedor.index')->with('sucesso', 'Fornecedor excluído com sucesso!');
    }

    // Confirma exclusão (opcional, se quiser view separada)
    public function confirmaExcluir(Request $request)
    {
        $request->validate(['id' => 'required|exists:fornecedores,id']);
        $fornecedor = Fornecedor::findOrFail($request->id);

        return view('fornecedor.confirmaExcluir', [
            'id' => $fornecedor->id,
            'nome' => $fornecedor->nome,
            'email' => $fornecedor->email,
            'site' => $fornecedor->site,
            'uf' => $fornecedor->uf
        ]);
    }
}
