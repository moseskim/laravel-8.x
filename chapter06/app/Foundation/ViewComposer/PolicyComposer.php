<?php

declare(strict_types=1);

namespace App\Foundation\ViewComposer;

use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\View\View;

/**
 * 리스트 6.5.3.3 허가를 수반하는 프레젠테이션 로직 구현 예
 */
final class PolicyComposer
{
    private $gate;
    private $authManager;

    public function __construct(Gate $gate, AuthManager $authManager)
    {
        $this->gate = $gate;
        $this->authManager = $authManager;
    }

    public function compose(View $view)
    {
        $allow = $this->gate->forUser(
            $this->authManager->guard()->user()
        )->allows('edit');
        // ①
        if ($allow) {
            $view->getFactory()->inject('authorized', 'allowed');
        }
        $view->getFactory()->inject('authorized', 'denied');
    }
}