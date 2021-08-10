<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\View\View;
use RuntimeException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class AppException extends RuntimeException implements Responsable
{
    protected $error = 'error';
    private $factory;

    /**
     * @param View $factory
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(
        View $factory,
        string $message = "",
        int $code = 0,
        Throwable $previous = null
    ) {
        $this->factory = $factory;
        parent::__construct($message, $code, $previous);
    }

    public function toResponse($request): Response // ①
    {
        return new Response(
            $this->factory->with($this->error, $this->message)->render()
        );
    }
}
