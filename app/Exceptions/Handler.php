<?php

namespace App\Exceptions;

use App\Jobs\ExceptionOccured;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
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
            $this->sendEmail($e);
        });
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function sendEmail(Throwable $exception)
    {
        try {
            dispatch( new ExceptionOccured($this->getExceptionDetails($exception)) );
        } catch (Throwable $exception) {
            Log::error($exception);
        }
    }

    protected function getExceptionDetails($exception)
    {
        $traces = [];
        foreach ($exception->getTrace() as $trace) {
            $traces[] = [
                'file'      => $trace['file'] ?? '',
                'line'      => $trace['line'] ?? '',
                'function'  => $trace['function'] ?? '',
                'class'     => $trace['class'] ?? '',
                'type'      => $trace['type'] ?? '',
            ];
        }

        return [
            'message' => $exception->getMessage(),
            'file'    => $exception->getFile(),
            'line'    => $exception->getLine(),
            'trace'   => $traces,
            'url'     => request()->url(),
            'body'    => request()->all(),
            'ip'      => request()->ip(),
        ];
    }
}
