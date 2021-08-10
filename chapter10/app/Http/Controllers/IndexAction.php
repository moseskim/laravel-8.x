<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\UserResourceException;
use Illuminate\Http\Request;
use Psr\Log\LoggerInterface;

use function logs;

final class IndexAction extends Controller
{
    /** @var LoggerInterface */
    private $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    public function __invoke(
        Request $request
    ) {
        throw new UserResourceException('error');
        $this->logger
            ->driver('elasticsearch')
            ->info(
                'user.action',
                [
                    'uri' => $request->getUri(),
                    'referer' => $request->headers->get('referer', ''),
                    'user_id' => 1,
                    'query' => $request->query->all()
                ]
            );
        // Logファサード、またはlogsヘルパー関数も利用できます。
        logs('elasticsearch')->info(
            'user.action',
            [
                'uri' => $request->getUri(),
                'referer' => $request->headers->get('referer', ''),
                'user_id' => 1,
                'query' => $request->query->all()
            ]
        );
    }
}
