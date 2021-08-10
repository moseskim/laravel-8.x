<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Support\Facades\Response;

use function response;
use function view;

final class ViewAction extends Controller
{
    public function __invoke(Request $request)
    {
        $response = Response::view('view.file');
        // 위 메서드와 같은 결과를 얻는다
        $response = view('view.file');
        // 상태 코드를 변경하고 뷰를 출력한다
        $response = response(view('view.file'), IlluminateResponse::HTTP_ACCEPTED);
        return $response;
    }
}
