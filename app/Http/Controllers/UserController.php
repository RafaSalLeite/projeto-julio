<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Listar usuários
    public function index(){
        $registros = User::all();
        if ($registros->count() == 0){
            session(['erro' => 'Nenhum Usuário Encontrado!']);
        }
        return view('user.index', compact('registros'));
    }

    // Salvar novo usuário
    public function salvarnovo(Request $req){
        session()->flash('Modal','ModalNovoUsuario');

        $req->validate([
            'email' => 'required|max:255|unique:users,email',
            'name' => 'required|max:255',
            'password' => 'required|min:4|max:255',
            'permissao' => 'required|in:Admin,Normal,Leitura',
        ], [
            'email.unique' => 'Já existe um Usuário cadastrado com este Email!',
            'email.required|max' => 'O campo Email é obrigatório e deve ter no máximo 255 caracteres!',
            'name.*' => 'O campo Nome é obrigatório e deve ter no máximo 255 caracteres!',
            'password.*' => 'O campo Senha é obrigatório e deve ter no mínimo 4 caracteres!',
            'permissao.*' => 'Selecione uma permissão!'
        ]);

        // Grava no banco com senha hash
        User::create([
            'email' => $req->email,
            'name' => $req->name,
            'password' => Hash::make($req->password),
            'permissao' => $req->permissao
        ]);

        return redirect('/user')->with('sucesso', 'Usuário Cadastrado.');
    }

    // Salvar usuário editado
    public function salvarEditado(Request $req){
        session()->flash('Modal','ModalEditarUsuario');

        $req->validate([
            'email' => 'required|max:255|unique:users,email,' . $req->id,
            'name' => 'required|max:255',
            'permissao' => 'required|in:Admin,Normal,Leitura',
        ], [
            'email.unique' => 'Já existe um Usuário cadastrado com este Email!',
            'email.required|max' => 'O campo Email é obrigatório e deve ter no máximo 255 caracteres!',
            'name.*' => 'O campo Nome é obrigatório e deve ter no máximo 255 caracteres!',
            'permissao.*' => 'Selecione uma permissão!'
        ]);

        $usuario = User::find($req->id);
        if ($usuario){
            $usuario->update([
                'email' => $req->email,
                'name' => $req->name,
                'permissao' => $req->permissao
            ]);
            return redirect('/user')->with('sucesso', 'Usuário atualizado com sucesso.');
        } else {
            return redirect('/user')->with('erro', 'Usuário não encontrado!');
        }
    }

    // Resetar/atualizar senha
    public function atualizarSenha(Request $req){
        session()->flash('Modal','ModalRessetarSenha');

        $req->validate([
            'password' => 'required|min:4|max:255',
        ], [
            'password.*' => 'O campo Senha é obrigatório e deve ter no mínimo 4 caracteres!'
        ]);

        $usuario = User::find($req->id);
        if ($usuario){
            $usuario->password = Hash::make($req->password);
            $usuario->save();
            return redirect('/user')->with('sucesso', 'Senha atualizada com sucesso.');
        } else {
            return redirect('/user')->with('erro', 'Usuário não encontrado!');
        }
    }

    // Excluir usuário
    public function excluir(Request $req){
        try {
            $usuario = User::findOrFail($req->id);
            $usuario->delete();
            return redirect('/user')->with('sucesso', 'Usuário excluído com sucesso!');
        } catch (ModelNotFoundException $e){
            return redirect('/user')->with('erro', 'Usuário NÃO encontrado!');
        }
    }
}
