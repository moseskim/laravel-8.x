<?php

declare(strict_types=1);

namespace App\Http\Controllers\Layered;

use App\Http\Controllers\Controller;
use App\Service\UserPurchaseService;

use function intval;
use function view;

final class UserController extends Controller
{
    /** @var UserPurchaseService */
    private $service;

    /**
     * UserController constructor.
     *
     * @param UserPurchaseService $service
     */
    public function __construct(UserPurchaseService $service)
    {
        $this->service = $service;
    }

    /**
     * @param string $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(string $id)
    {
        $result = $this->service->retrievePurchase(intval($id));
        return view('user.index', ['user' => $result]);
    }
}
