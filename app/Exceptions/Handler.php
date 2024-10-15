<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->renderable(function (Throwable $e, $request) {
            if ($request->is('api/*')) {
                if (request()->is('api/*') && ($e->getPrevious() instanceof  ModelNotFoundException)) {
                    $message = match ($e->getPrevious()->getModel()) {
                     'App\Models\kyc' => 'kyc not found.'
                              
                     };
                     return response()->json(['message' => $message],Response::HTTP_NOT_FOUND);
                 }else{
                    return response()->json([
                        'message' => $e->getMessage(),
                    ], 500);
                }
            }
        });
    }
}
