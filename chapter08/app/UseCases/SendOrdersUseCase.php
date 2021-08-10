<?php

declare(strict_types=1);

namespace App\UseCases;

use App\Services\ExportOrdersService;
use Carbon\CarbonImmutable;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

final class SendOrdersUseCase
{
    /** @var ExportOrdersService */
    private $service;
    /** @var Client */
    private $guzzle;

    public function __construct(ExportOrdersService $service, Client $guzzle)
    {
        $this->service = $service;
        $this->guzzle = $guzzle;
    }

    /**
     * @throws GuzzleException
     */
    public function run(CarbonImmutable $targetDate): int
    {
        // ① 데이터베이스에 구배 정보를 얻음
        $orders = $this->service->findOrders($targetDate);

        // ② 송신용 데이터 작성
        $json = collect();
        $order = null;
        foreach ($orders as $detail) {
            if ($detail->detail_no === 1) {
                if (is_array($order)) {
                    $json->push($order);
                }
                $order = [
                    'order_code' => $detail->order_code,
                    'order_date' => $detail->order_date,
                    'total_quantity' => $detail->total_quantity,
                    'total_price' => $detail->total_price,
                    'customer_name' => $detail->customer_name,
                    'customer_email' => $detail->customer_email,
                    'destination_name' => $detail->destination_name,
                    'destination_zip' => $detail->destination_zip,
                    'destination_prefecture' => $detail->destination_prefecture,
                    'destination_address' => $detail->destination_address,
                    'destination_tel' => $detail->destination_tel,
                    'order_details' => [],
                ];
            }
            $order['order_details'][] = [
                'detail_no' => $detail->detail_no,
                'item_name' => $detail->item_name,
                'item_price' => $detail->item_price,
                'quantity' => $detail->quantity,
                'subtotal_price' => $detail->subtotal_price,
            ];
        }
        if (is_array($order)) {
            $json->push($order);
        }

        // ③ JSON 송신
        $url = config('batch.import-orders-url');
        $this->guzzle->post(
            $url,
            [
                'json' => $json,
            ]
        );

        return $json->count();
    }
}
