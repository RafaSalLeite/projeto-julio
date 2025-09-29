@extends('layout.site')

@section('main')
<div class="container mt-4">
    <h1 class="text-center">Excluir Fornecedor</h1>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card bg-danger text-white">
                <div class="card-header">
                    <h5>Confirmação de Exclusão do Fornecedor</h5>
                </div>
                <div class="card-body">
                    <p>Tem certeza de que deseja excluir o fornecedor: <strong>{{ $nome }}</strong>?</p>
                    <p>Email: <strong>{{ $email }}</strong></p>
                    <p>Site: <strong>{{ $site ?? 'N/A' }}</strong></p>
                    <p>UF: <strong>{{ $uf ?? 'N/A' }}</strong></p>
                </div>
                <div class="card-footer text-end">
                    <form action="{{ route('fornecedor.confirmaExcluir') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $id }}">
                        <button type="submit" class="btn btn-danger">Confirmar</button>
                        <a href="{{ route('fornecedor.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
