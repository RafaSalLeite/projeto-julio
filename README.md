# projeto-julio
Sistema de gerenciamento de produtos e fornecedores.
Instalação

Clone o repositório:

git clone https://github.com/seu-usuario/seu-projeto.git
cd seu-projeto


Instale as dependências do PHP:

composer install


Instale as dependências do frontend:

npm install


Copie o arquivo de ambiente:

cp .env.example .env


Configure o arquivo .env com os dados do seu banco de dados:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha


⚠️ Dica: Se der erro de caching_sha2_password no MySQL, altere o usuário root para mysql_native_password.

Configuração do Laravel

Gere a chave da aplicação:

php artisan key:generate


Crie as tabelas no banco de dados (migrations):

php artisan migrate


Se houver seeders para popular o banco:

php artisan db:seed


Compile os assets do frontend:

npm run dev


ou para produção:

npm run build

Estrutura de Tabelas

Produtos (products)

id, nome, preço, quantidade, fornecedor_id, created_at, updated_at

Fornecedores (fornecedors)

id, nome, email, telefone, created_at, updated_at

⚠️ Observação: Ajuste os nomes das tabelas conforme seu projeto. Se a tabela não existir, você terá erro de “Table not found”.

Modais

O sistema usa modais Bootstrap para criar, editar e deletar produtos/fornecedores.

Os modais aparecem automaticamente em caso de erro ou sucesso.

Script usado para abrir modal automaticamente:

@if ($errors->any())
  <script>
      document.addEventListener("DOMContentLoaded", function () {
          var modal = new bootstrap.Modal(document.getElementById("{{ session('Modal') }}"));
          modal.show();
      });
  </script>
@endif

Executando a Aplicação

Rodando o servidor Laravel:

php artisan serve


Por padrão: http://127.0.0.1:8000

Acesse e teste:

Listagem de produtos: /produtos

Listagem de fornecedores: /fornecedores

Teste os modais para criar, editar e excluir.
