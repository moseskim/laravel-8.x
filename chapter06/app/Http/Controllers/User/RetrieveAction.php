<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;
use stdClass;

final class RetrieveAction extends Controller
{
    private $authManager;
    private $gate;

    public function __construct(
        AuthManager $authManager,
        Gate $gate
    ) {
        $this->authManager = $authManager;
        $this->gate = $gate;
    }

    public function __invoke(Request $request)
    {
        /** @var User $user */
        $user = $this->authManager->guard('jwt')->user();
        // 허가 여부를 확인한다
        $can = $this->gate->allows('user-access', $user->getAuthIdentifier());

        /*
         * 경로에 의한 값을 이용하는 경우
        if ($this->gate->allows('user-access', $id)) {
            // 실행이 허가되면 실행
        }
        */

        // 리스트 6.5.2.13 정책 클래스 이용 예
        /*
        $class = new stdClass();
        $class->id = 1;
        // ①
        $this->gate->forUser(
            $this->authManager->guard()->user()
        )->allows('edit', $class);
        */
    }
}
