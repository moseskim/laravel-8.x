<?php

declare(strict_types=1);

namespace App\Http\Actions;

use App\Http\Requests\AddPointRequest;
use App\UseCases\AddPointUseCase;
use Carbon\CarbonImmutable;
use Illuminate\Http\JsonResponse;
use Throwable;

class AddPointAction
{
    /** @var AddPointUseCase */
    private $useCase;

    public function __construct(AddPointUseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    /**
     * @throws Throwable
     */
    public function __invoke(AddPointRequest $request): JsonResponse
    {
        $customerId = filter_var($request->json('customer_id'), FILTER_VALIDATE_INT);
        $addPoint = filter_var($request->json('add_point'), FILTER_VALIDATE_INT);

        $customerPoint = $this->useCase->run(
            $customerId,
            $addPoint,
            "ADD_POINT",
            CarbonImmutable::now()
        );

        return response()->json(['customer_point' => $customerPoint]);
    }
}
