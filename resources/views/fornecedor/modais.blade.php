<!-- Modal Novo Fornecedor -->
<div class="modal fade" id="ModalNovoFornecedor">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar Novo Fornecedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('fornecedor.salvar') }}" method="POST">
                @csrf
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-group mb-2">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" id="nome" class="form-control" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="site">Site</label>
                        <input type="text" name="site" id="site" class="form-control">
                    </div>
                    <div class="form-group mb-2">
                        <label for="uf">UF</label>
                        <input type="text" name="uf" id="uf" class="form-control" maxlength="2">
                    </div>
                    <div class="form-group mb-2">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-outline-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar Fornecedor -->
<div class="modal fade" id="ModalEditarFornecedor">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Fornecedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('fornecedor.salvarEditado') }}" method="POST">
                @csrf
                <input type="hidden" name="id" id="idf">
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label for="nomeed">Nome</label>
                        <input type="text" name="nome" id="nomeed" class="form-control" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="siteed">Site</label>
                        <input type="text" name="site" id="siteed" class="form-control">
                    </div>
                    <div class="form-group mb-2">
                        <label for="ufed">UF</label>
                        <input type="text" name="uf" id="ufed" class="form-control" maxlength="2">
                    </div>
                    <div class="form-group mb-2">
                        <label for="emailed">Email</label>
                        <input type="email" name="email" id="emailed" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-outline-primary">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Excluir Fornecedor -->
<div class="modal fade" id="ModalExcluirFornecedor">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Confirmação de Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('fornecedor.excluir') }}" method="POST">
                @csrf
                <input type="hidden" name="id" id="idex">
                <div class="modal-body">
                    <p>Tem certeza que deseja excluir o fornecedor:</p>
                    <p><strong id="nomeexshow"></strong></p>
                    <p><strong id="emailexshow"></strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-outline-danger">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Scripts para passar dados aos modais -->
<script>
    // Passa parâmetros para o Modal Editar
    $('#ModalEditarFornecedor').on('shown.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var idf = button.data('idf');
        var nome = button.data('nome');
        var site = button.data('site');
        var uf = button.data('uf');
        var email = button.data('email');

        var modal = $(this);
        modal.find('#idf').val(idf);
        modal.find('#nomeed').val(nome);
        modal.find('#siteed').val(site);
        modal.find('#ufed').val(uf);
        modal.find('#emailed').val(email);
    });

    // Passa parâmetros para o Modal Excluir
    $('#ModalExcluirFornecedor').on('shown.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var idex = button.data('idex');
        var nome = button.data('nomeex');
        var email = button.data('emailex');

        var modal = $(this);
        modal.find('#idex').val(idex);
        modal.find('#nomeexshow').text(nome);
        modal.find('#emailexshow').text(email);
    });

    // Autofocus no campo Nome do Novo Fornecedor
    const modalNovo = document.getElementById('ModalNovoFornecedor');
    modalNovo.addEventListener('shown.bs.modal', function () {
        document.getElementById('nome').focus();
    });
</script>
