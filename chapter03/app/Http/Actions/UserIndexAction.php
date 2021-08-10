<?php
declare(strict_types=1);

namespace App\Http\Actions;

use App\Service\UserService;
use App\Http\Responder\UserResponder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

final class UserIndexAction extends Controller
{
    /** @var UserService */
    private $domain;

    /** @var UserResponder */
    private $userResponder;

    /**
     * UserIndexAction constructor.
     * ①
     * @param UserService   $userService
     * @param UserResponder $userResponder
     */
    public function __construct(
        UserService $userService,
        UserResponder $userResponder
    ) {
        $this->domain = $userService;
        $this->userResponder = $userResponder;
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        return $this->userResponder->response(
            $this->domain->retrieveUser($request->get('id', '1'))
        );
    }
}
