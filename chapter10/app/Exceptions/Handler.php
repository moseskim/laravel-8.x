<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
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
        $this->reportable(
            function (Throwable $e) {
                //
            }
        );
    }

    public function render($request, Throwable $e)
    {
        // 리스트 10.1.5.3 커스텀 헤더를 이용한 에러 응답 구현
        // 송출된 Exception 클래스를 상속한 인터페이스 중 특정 예외만 처리를 변경
        if ($e instanceof QueryException) {
            // 커스텀 헤더를 이용해 에러 응답, 상태 코드 500을 반환
            return new Response('', Response::HTTP_INTERNAL_SERVER_ERROR, [
                'X-App-Message' => 'An error occurred.'
            ]);
        }
        return parent::render($request, $e);
    }

}
