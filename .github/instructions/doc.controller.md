# Delegação de Ações entre Controllers

Em vez de implementar toda a lógica diretamente no método do controller, utilize a delegação para controllers de ação (Action Controllers) usando o padrão:

```php
public function store(Request $request)
{
  return app(UserStoreController::class)($request);
}
```

Isso permite separar a lógica de domínio da definição da rota/controller, facilitando manutenção, testes e reaproveitamento.

---

# Métodos Utilitários no Controller Base

Implemente métodos utilitários no controller base para padronizar respostas e tratamento de erros:

```php
protected static function success(?string $view = null, ?array $data = null, int $code = 200)
{
  if (self::isApi()) {
    return response()->json(['success' => true, 'data' => $data], $code);
  }
  if(Self::$back) return redirect()->back();
  return view($view, $data);
}

protected static function fatal(?string $message = null, $exception = null, int $code = 500)
{
  // Log, tratamento e resposta padronizada de erro
  if (self::isApi()) {
    return response()->json(['success' => false, 'error' => $message], $code);
  }
  return redirect()->back()->withErrors(['error' => $message]);
}
```

---

# Tratamento Padronizado de Exceções

Utilize sempre try/catch nos métodos dos controllers para garantir respostas amigáveis e padronizadas em caso de erro:

```php
public function __invoke(Request $request)
{
  try {
    // lógica
    return self::success('view', $data);
  } catch (\Exception $exception) {
    return self::fatal('Mensagem de erro', $exception);
  }
}
```

---

# Controllers de Ação (Action Controllers)

Implemente controllers de ação para isolar a lógica de cada operação. O controller de rota apenas delega:

```php
public function store(Request $request)
{
  return app(UserStoreControllerAction::class)($request);
}
```

---

# Respostas Web e API

Os métodos utilitários do controller base devem diferenciar automaticamente entre resposta para web (view/redirect) e API (JSON), conforme o contexto da requisição.

---

# Assinatura dos Métodos

Prefira usar model binding do Laravel quando possível:

```php
public function destroy(User $user)
{
  // ...
}
```
Ou, se necessário, receba o id e faça a busca manualmente:

```php
public function destroy(Request $request, $id)
{
  $user = User::findOrFail($id);
  // ...
}
```

Padronize a assinatura conforme a necessidade do domínio e clareza do código.

---
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