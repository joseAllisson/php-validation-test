# Teste laravel uhuu

Sistema para gerenciar clientes com autenticação segura e funcionalidades de CRUD.

## Funcionalidades

- **Autenticação Segura**:
  - Implementação do Google reCAPTCHA para validação.
- **Gerenciamento de Clientes**:
  - Criar, Listar, Editar e Deletar Clientes.
  - Paginação com 20 itens por página.
  - Filtro e ordenação por diferentes campos.

---

## Passos para Inicializar o Projeto

- 1. Clonar o Repositório
- 2. Criar arquivo .env seguindo exemplo do .env.example
- 3. php artisan key:generate
- 4. Adicione as chaves do Google reCAPTCHA no arquivo .env ou deixar a de desenvolvimento
- 5. Rodar projeto com sail:
./vendor/bin/sail up -d
- 6. rodar migrations:
./vendor/bin/sail artisan migrate
- 7. Para funcionar o tailwind é necessario rodar:
npm run dev 


