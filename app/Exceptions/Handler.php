<?php

namespace Nuvem\Exceptions;

use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Symfony\Component\HttpKernel\Exception\NotFoundHttpException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        $response = [];

        if ($this->isHttpException($exception)) {
            /** @var HttpException $httpException */
            $httpException = $exception;
            $status = $httpException->getStatusCode();
        }

        if ($exception->getMessage()) {
            $response['message'] = $exception->getMessage();
        }

        if ($exception instanceof ValidationException) {
            $status = Response::HTTP_UNPROCESSABLE_ENTITY;
            $validationException = $exception;
            $response['message'] = trans('validation.message');
            $response['errors']  = $validationException->validator->messages();
        }

        if (config('app.debug')) {
            $response['exception'] = get_class($exception);
            $response['trace']     = $exception->getTrace();
        }

        return response()->json($response, $status);
    }
}
