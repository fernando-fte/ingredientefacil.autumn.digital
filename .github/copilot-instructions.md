## Boas práticas para diretivas Blade em atributos HTML

**Nunca** utilize diretivas Blade como `@error`, `@enderror`, `@if`, `@endif` diretamente dentro de atributos de tags HTML (ex: class="...").

**Correto:**
```blade
<input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">
```

**Errado:**
```blade
<input class="form-control @error('password') is-invalid @enderror">
```

Sempre utilize a interpolação `{{ ... }}` para lógica condicional em atributos.
# Copilot Instructions for AI Agents

## Visão Geral do Projeto
- **ingredientefacil** é um sistema multi-tenant para gestão de insumos, ofertas, receitas, inventário e usuários, focado em cozinhas profissionais.
- Backend em **Laravel 12 (PHP 8.3)**, frontend com **Blade**, **Bootstrap** e **FontAwesome**, banco de dados **MySQL 8.0**.
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

### Scripts em Componentes Blade

**Boas práticas para scripts em componentes Blade reutilizáveis:**

- Sempre que um componente Blade precisar de JavaScript próprio, utilize o stack Blade (`@push('scripts')`) junto com a diretiva `@once`. Isso garante que o script será incluído apenas uma vez no final da página, mesmo que o componente seja chamado múltiplas vezes em diferentes partes da view.

- Para evitar conflitos entre múltiplas instâncias do mesmo componente, nunca utilize IDs fixos em elementos HTML. Prefira sempre data-atributos exclusivos (ex: `data-profile-edit-*`). Assim, cada instância do componente pode ser manipulada de forma isolada pelo JavaScript.

- Quando houver elementos que podem aparecer repetidamente na página (exemplo: múltiplos formulários do mesmo tipo), selecione todos eles usando `document.querySelectorAll` e itere sobre o resultado, aplicando listeners individualmente a cada elemento. Isso evita que um script afete apenas o primeiro elemento encontrado ou cause bugs ao manipular múltiplas instâncias.

- Nunca use `getElementById` para elementos que podem se repetir, pois IDs devem ser únicos por página e podem causar comportamento inesperado.

**Exemplo de uso recomendado:**
  - No componente Blade:
    ```blade
    @once
        @push('scripts')
            <script>
            document.querySelectorAll('[data-profile-edit-password-form]').forEach(form => {
                // Adicione listeners e lógica para cada form individualmente
            });
            </script>
        @endpush
    @endonce
    ```
  - No layout principal, antes do `</body>`:
    ```blade
    @stack('scripts')
    ```
- **Rotas:**
  - API: `routes/api.php` (RESTful, usa apiResource)
  - Web: `routes/web.php` (Blade, renderiza views)
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
  - Views Blade em `resources/views/`
  - Estilos com Bootstrap (veja `public/` e `resources/`)
  - Ícones com FontAwesome

## Outras Dicas
- Variáveis de ambiente: veja `.env.example`.
- Sempre siga PSR-12 e padrões Laravel.
- Consulte README.md e `.github/instructions/` para detalhes de domínio e integrações.
