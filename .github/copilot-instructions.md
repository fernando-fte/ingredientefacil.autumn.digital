# Copilot Instructions for AI Agents

## Visão Geral do Projeto
- **Comida em Casa API** é um sistema multi-tenant para gestão de insumos, ofertas, receitas, inventário e usuários, focado em cozinhas profissionais.
- Backend em **Laravel 12 (PHP 8.3)**, frontend com **Inertia.js** e **Vue 3**, banco de dados **MySQL 8.0**.
- Autenticação via **Laravel Sanctum** (token API).
- Deploy e desenvolvimento via **Docker/Laravel Sail**.

## Fluxos e Comandos Essenciais
- **Setup local:**
  ```bash
  composer install
  npm install
  cp .env.example .env
  php artisan key:generate
  ./vendor/bin/sail up -d
  ./vendor/bin/sail artisan migrate --seed
  ```
- **Testes:**
  ```bash
  ./vendor/bin/sail test
  ./vendor/bin/sail test --coverage
  ```
- **Build Frontend:**
  ```bash
  npm run build
  # ou
  ./vendor/bin/sail npm run build
  ```
- **Documentação:**
  - OpenAPI/Swagger: `/docs` ou `public/openapi.yaml`
  - Documentação extra: `.github/instructions/`

## Arquitetura e Convenções
- **Rotas:**
  - API: `routes/api.php` (RESTful, usa apiResource)
  - Web: `routes/web.php` (Inertia.js, renderiza Vue)
- **Controllers:**
  - Preferência por **Single-Action Controllers** para endpoints REST.
  - Validação via **Form Request** (ex: `app/Http/Requests/`)
- **Multi-Tenancy:**
  - Isolamento por cozinha (kitchen) com permissões granulares (pivot JSON).
  - Veja `.github/instructions/doc.cozinhas.instructions.md` para detalhes.
- **Respostas:**
  - Use **API Resources** para formatação de respostas JSON.
- **Testes:**
  - Testes em `tests/Feature` e `tests/Unit`. Cobertura obrigatória para novas features.
- **Seeders:**
  - Seeders customizados em `database/seeders/`. Use `sail artisan migrate --seed` para popular dados.

## Integrações e Padrões Específicos
- **Autenticação:**
  - Login: `POST /api/auth/login` → token JWT
  - Header: `Authorization: Bearer {token}`
- **Controle de Estoque:**
  - FIFO implementado em inventário.
- **Permissões:**
  - Controle por módulo/ação, configurado via JSON na tabela pivot.
- **Frontend:**
  - Componentes Vue em `resources/js/Pages/`
  - Estilos com TailwindCSS (`resources/css/app.css`)
  - Build com Vite (`vite.config.js`)

## Exemplos de Rotas Importantes
- `GET /api/dashboard/stats` — Estatísticas gerais
- `CRUD /api/insumos` — Ingredientes
- `POST /api/insumos/{id}/share` — Compartilhamento de insumos (autenticado)
- `GET /api/receitas/gargalos` — Alertas de produção

## Outras Dicas
- Variáveis de ambiente: veja `.env.example`.
- Sempre siga PSR-12 e padrões Laravel.
- Consulte README.md e `.github/instructions/` para detalhes de domínio e integrações.
