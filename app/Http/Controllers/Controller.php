<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class Controller
{
    use AuthorizesRequests;
    use ValidatesRequests;

    CONST BACK = 'back';
    protected static $back;
    protected static $message;

    protected static function success(?string $view = null, ?array $data = null, int $code = 200) //: JsonResponse|Response
    {
        if (self::isApi()) {
            return response()->json(['success' => true, 'data' => $data], $code);
        }

        # # Uso comm inertia
        # $data['view'] = (object)[
        #     'route' => (object)[
        #         'name' => null,
        #         'url' => null
        #     ],
        # ];
        # return Inertia::render($view, $data);

        if(Self::$back) return redirect()->back();

        return view($view, $data);
    }

    protected static function error(?string $message = null, ?array $error = null, int $code = 400) //: JsonResponse|RedirectResponse
    {
        $response = (object) [
            'success' => false,
            'error'   => (object) [
                'message' => $message
            ]
        ];

        if ($error) {
            foreach (array_keys($error) as $errorKey) {
                $response->error->{$errorKey} = $error[$errorKey];
            }
        }

        if (self::isApi()) {
            return response()->json($response, $code);
        }

        return back()->withErrors($response->error);
    }

    protected static function fatal(?string $message = null, Exception $exception) //: JsonResponse|RedirectResponse
    {
        $fatal = (object) [
            '_message' => $exception->getMessage(),
            'file'    => $exception->getFile() . ':' . $exception->getLine()
        ];

        return self::error($message, ['fatal' => $fatal], 500);
    }

    protected static function abort(?string $message = null, int $code = 400) //: JsonResponse|RedirectResponse
    {
        if (self::isApi()) {
            return self::error($message, null, $code);
        }

        return abort($message, $code);
    }

    protected static function redirect(string $route, ?array $keysRedirect = null, array $data = [], int $code = 200)
    {
        if (self::isApi()) {
            return response()->json(['success' => true, 'data' => $data], $code);
        }
        if (isset($data['message'])) {
            session()->flash('_message', $data['message']);
            session()->flash('_type', 'success');
            session()->flash('_timer', 5000);
        }

        return redirect()->route($route, $keysRedirect[0] ?? null);
    }

    protected static function back(?string $message = null): Self
    {
        Self::$back = true;
        Self::$message = $message;
        return (new Self);
    }

    protected static function formatPaginate(LengthAwarePaginator $paginate, bool $onlyApi = true)//: LengthAwarePaginator|object
    {
        # Só formata se for resposta api
        if (!self::isApi() && $onlyApi) {
            return $paginate;
        }

        return (object)[
            'total' => $paginate->total(),
            'perPage' => $paginate->perPage(),
            'currentPage' => $paginate->currentPage(),
            'lastPage' => $paginate->lastPage(),
            'list' => $paginate->items(),

        ];
    }

    protected static function isApi(): bool
    {
        return request()->is('api/*') || request()->expectsJson() || request()->ajax();
    }
}
