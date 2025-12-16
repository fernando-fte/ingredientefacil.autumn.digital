# 📄 Para padrões e boas práticas de controllers e rotas, consulte `.github/instructions/doc.controller.md`.
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


## Organização Recomendada das Rotas (`web.php`)

- **Agrupe rotas por domínio usando `prefix` e `name`:**
  - Exemplo: `Route::prefix('perfil')->name('web.profile.')->group(function () { ... });`
  - Facilita manutenção, leitura e uso de nomes de rota nas views.

- **Proteja rotas sensíveis com middleware:**
  - Use `Route::middleware('auth')->group(function () { ... });` para garantir acesso apenas autenticado.

- **Use Single Action Controllers para ações isoladas:**
  - Exemplo: `Route::get('/', ProfileEditController::class)->name('edit');`

- **Use Multi Action Controllers para recursos CRUD:**
  - Exemplo: `Route::get('/', [UsersController::class, 'index'])->name('index');`

- **Padronize nomes de rotas:**
  - Utilize prefixos e nomes claros, como `web.profile.edit`, `web.users.index`.

- **Inclua arquivo de autenticação separado:**
  - `require __DIR__.'/auth.php';` mantém as rotas de autenticação organizadas.

- **Dica:**
  - Para projetos grandes, considere `Route::resource` para recursos RESTful.

---

# Padrão de Controllers (Single Action e Multi Action)

## Estrutura e Convenções Gerais
- **Localização:**
  - Controllers devem ser criados em `app/Http/Controllers/` e, se necessário, organizados em subpastas por domínio (ex: `Profile/`, `User/`, `Admin/`).
- **Namespace:**
  - Deve refletir a estrutura de pastas, ex: `App\Http\Controllers\Profile`.
- **Controller principal/base:**
  - Todos os controllers devem estender `App\Http\Controllers\Controller` (ou um controller base específico do domínio, se necessário, como `ProfileController`).
  - Exemplo de declaração:
    ```php
    namespace App\Http\Controllers\Profile;

    use App\Http\Controllers\Controller;

    class ProfileEditController extends Controller
    {
        // ...
    }
    ```
- **Single Action Controller:**
  - Use o método `__invoke(Request $request)` para controllers de ação única.
- **Multi Action Controller:**
  - Use métodos nomeados (`index`, `store`, `update`, etc.) para controllers com múltiplas ações.

## Fluxo de Execução (Exemplo Genérico)
1. **Recebe um Form Request customizado (opcional):**
   - Centralize regras e mensagens de validação em um Form Request dedicado.
2. **Executa a lógica de domínio:**
   - Exemplo: buscar, criar, atualizar ou remover recursos.
3. **Manipula autenticação/autorização:**
   - Use `Auth::user()` ou policies se necessário.
4. **Manipula sessão e redirecionamento:**
   - Exemplo: `session()->invalidate()`, `Redirect::route(...)`.
5. **Retorna resposta adequada:**
   - View, redirect, JSON, etc.

## Validação
- **Sempre que possível, mova a validação para um Form Request**:
  - Defina regras e mensagens customizadas no Form Request.
  - O controller deve assumir que os dados já estão validados.

## Boas práticas aplicadas
- **Responsabilidade única:**
  Controllers devem ser enxutos, delegando validação e lógica de negócio para Requests, Services ou Models.
- **Mensagens de erro centralizadas:**
  Todas as mensagens de validação devem estar no Form Request.
- **Segurança:**
  Implemente autenticação/autorização e manipulação segura de sessão.
- **Padrão Laravel:**
  Siga o padrão PSR-12, utilize Single Action Controllers quando possível e aproveite Form Requests.

---

Use este modelo para documentar controllers de qualquer domínio, adaptando exemplos e fluxos conforme a necessidade do recurso.


