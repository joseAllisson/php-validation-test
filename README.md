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

- Clonar o Repositório
- Criar arquivo .env seguindo exemplo do .env.example
- php artisan key:generate
- Adicione as chaves do Google reCAPTCHA no arquivo .env ou deixar a de desenvolvimento
- Rodar projeto com sail:
````bash
./vendor/bin/sail up -d
````
- rodar migrations:
````bash
./vendor/bin/sail artisan migrate
````
- Para funcionar o style tailwind é necessario rodar:
````bash
npm run dev
````


