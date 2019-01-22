<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        //return parent::render($request, $exception);
        return $this->formatException($request, $exception);
    }

    /**
     * @param $request
     * @param Exception $exception
     * @return mixed
     */
    private function formatException ($request, Exception $exception) {
        $statusCode = 400;
        $data = [];
        switch (get_class($exception)) {
            case NotFoundHttpException::class:
                $statusCode = 404;
                $data = [ 'error' => 'Invalid uri' ];
                break;
            case ValidationException::class:
                $statusCode = 422;
                $errors = [];
                foreach ($exception->errors() as $key => $value) {
                    //$data[$key] = $value[0];
                    array_push($errors, $value[0]);
                }
                $data = ['error' => implode(',', $errors)];
                break;
            default:
                $data = [ 'error' => $exception->getMessage() ];
                break;
        }

        return Response::error($data, $statusCode);
    }
}
