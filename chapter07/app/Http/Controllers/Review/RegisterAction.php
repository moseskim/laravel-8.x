<?php

declare(strict_types=1);

namespace App\Http\Controllers\Review;

use App\DataProvider\RegisterReviewProviderInterface;
use App\Events\ReviewRegistered;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class RegisterAction extends Controller
{
    /** @var RegisterReviewProviderInterface */
    private $provider;

    /** @var Dispatcher */
    private $dispatcher;

    // 데이터베이스 등록과 Event 트리거를 수행하는 클래스를 전달
    public function __construct(
        RegisterReviewProviderInterface $provider,
        Dispatcher $dispatcher
    ) {
        $this->provider = $provider;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $created = Carbon::now()->toDateTimeString();
        // 등록 처리 실행
        $id = $this->provider->save(
            $request->get('title'),
            $request->get('content'),
            $request->get('user_id', 1),
            $created,
            $request->get('tags')
        );
        // 등록 후 이벤트 트리거
        $this->dispatcher->dispatch(
            new ReviewRegistered(
                $id,
                $request->get('title'),
                $request->get('content'),
                $request->get('user_id', 1),
                $created,
                $request->get('tags')
            )
        );
        // POST로 동작하므로 등록 환류 후 HTTP Status만 반환
        return new Response('', Response::HTTP_OK);
    }
}
