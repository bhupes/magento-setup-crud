<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    use ApiResponser;

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
        Log::error("Error: ", [$exception->getMessage()]);

        if ($exception instanceof ModelNotFoundException) {
            return $this->sendError('Entry for ' . str_replace('App\\', '', $exception->getModel()) . ' not found', null, 405);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return $this->sendError('The specified method for the request is invalid', null, 405);
        }

        if ($exception instanceof NotFoundHttpException) {
            return $this->sendError('The specified URL cannot be found', null, 404);
        }

        if ($exception instanceof HttpException) {
            return $this->sendError($exception->getMessage(), $exception->getStatusCode());
        }

        return $this->sendError('Unexpected Exception. Try later', $exception->getMessage(), 500);

        // if (config('app.debug')) {
        //     return parent::render($request, $exception);
        // }
    }
}
