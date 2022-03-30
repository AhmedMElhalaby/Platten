<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ( $exception instanceof AuthorizationException) {
            if ($request->isJson() || $request->ajax() || $request->wantsJson())
                return response()->json(
                    [
                        'status' => [
                            'status'=>'fail',
                            'message' => [__( 'auth.unauthorized')],
                            'code' => 403,
                        ],
                    ],
                );
        }
        if ($exception instanceof NotFoundHttpException) {
            return response()->json(
                [
                    'status' => [
                        'status'=>'error',
                        'message' => 'Not Found',
                        'code' => 404,
                    ],
                ]
            );
        }
        return parent::render($request, $exception);
    }
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(
                [
                    'status' => [
                        'status'=>'fail',
                        'message' => [__( 'auth.unauthenticated')],
                        'code' => 401,
                    ],
                ],
            );
        }
        return redirect()->guest('login');
    }
}
