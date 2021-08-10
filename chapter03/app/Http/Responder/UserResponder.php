<?php
declare(strict_types=1);

namespace App\Http\Responder;

use Illuminate\Http\Response;
use Illuminate\Contracts\View\Factory as ViewFactory;
use App\User as UserModel;

class UserResponder
{
    protected $response;
    protected $view;

    /**
     * BookResponder constructor.
     *
     * @param Response    $response
     * @param ViewFactory $view
     */
    public function __construct(Response $response, ViewFactory $view)
    {
        $this->response = $response;
        $this->view = $view;
    }

    /**
     * @param UserModel $user
     *
     * @return Response
     */
    public function response(UserModel $user): Response
    {
        if (!$user->id) {
            $this->response->setStatusCode(Response::HTTP_NOT_FOUND);
        }
        $this->response->setContent(
            $this->view->make('user.index', ['user' => $user])
        );
        return $this->response;
    }
}
