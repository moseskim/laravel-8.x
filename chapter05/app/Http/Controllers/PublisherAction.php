<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\PublisherService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PublisherAction
{

    private $publisher;

    public function __construct(PublisherService $publisher)
    {
        $this->publisher = $publisher;
    }

    public function create(Request $request)
    {
        if ($this->publisher->exists($request->name)) {
            return response('', Response::HTTP_OK);
        }

        $id = $this->publisher->store($request->name, $request->address);
        return response('', Response::HTTP_CREATED)
            ->header('Location', '/api/publishers/' . $id);
    }

}
