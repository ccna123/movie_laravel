<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Support\Facades\Log;

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

    public function report(Throwable $e)
    {
        if (!config('app.debug')) {
            $message = "[{$e->getCode()}] \"{$e->getMessage()}\" in {$e->getFile()} at line {$e->getLine()}";
            Log::channel("error_log")->error($message, [
                'userId' => auth()->check() ? auth()->user()->id : 'guest',
                'url' => request()->fullUrl(),
                'method' => request()->method(),
                'ip' => request()->ip(),
            ]);
        } else {
            // If in debug mode, log the full stack trace
            parent::report($e);
        }
    }



    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
}
