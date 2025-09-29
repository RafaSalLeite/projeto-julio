@extends('layout.site')

@section('main')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-9"><h3>Manutenção de Fornecedores</h3></div>
        <div class="col-md-3">
            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#ModalNovoFornecedor">Novo Fornecedor</button>
        </div>
    </div>

    @if(session('sucesso'))
        <div class="alert alert-success mt-2">{{ session('sucesso') }}</div>
    @endif
    @if(session('erro'))
        <div class="alert alert-danger mt-2">{{ session('erro') }}</div>
    @endif

    <!-- Busca -->
    <form method="GET" action="{{ route('fornecedor.index') }}" class="mt-2 mb-2">
        <input type="text" name="busca" value="{{ request('busca') }}" placeholder="Buscar fornecedor..." class="form-control form-control-sm" />
    </form>

    <!-- Tabela -->
    <div class="table-responsive">
        <table class="table table-hover table-sm">
            <thead class="table-info">
                <tr>
                    <th>Nome</th>
                    <th>Site</th>
                    <th>UF</th>
                    <th>Email</th>
                    <th>Última Atualização</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($registros as $registro)
                <tr>
                    <td>{{ $registro->nome }}</td>
                    <td>{{ $registro->site }}</td>
                    <td>{{ $registro->uf }}</td>
                    <td>{{ $registro->email }}</td>
                    <td>{{ $registro->updated_at }}</td>
                    <td class="text-end">
                        <button class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#ModalEditarFornecedor"
                                data-idf="{{ $registro->id }}" data-nome="{{ $registro->nome }}" data-site="{{ $registro->site }}"
                                data-uf="{{ $registro->uf }}" data-email="{{ $registro->email }}">Editar</button>

                        <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#ModalExcluirFornecedor"
                                data-idex="{{ $registro->id }}" data-nomeex="{{ $registro->nome }}" data-emailex="{{ $registro->email }}">Excluir</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Paginação -->
    <div class="d-flex justify-content-end">{{ $registros->appends(request()->query())->links() }}</div>

    @include('fornecedor.modais') {{-- Modais separados --}}
</div>

@endsection
