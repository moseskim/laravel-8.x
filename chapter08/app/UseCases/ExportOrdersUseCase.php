<?php

declare(strict_types=1);

namespace App\UseCases;

use App\Services\ExportOrdersService;
use Carbon\CarbonImmutable;

final class ExportOrdersUseCase
{
    /** @var ExportOrdersService */
    private $service;

    public function __construct(ExportOrdersService $service)
    {
        $this->service = $service;
    }

    public function run(CarbonImmutable $targetDate): string
    {
        $orders = $this->service->findOrders($targetDate);

        $tsv = collect();
        $tsv->push($this->title());

        foreach ($orders as $order) {
            $tsv->push(
                [
                    $order->order_code,
                    $order->order_date,
                    $order->detail_no,
                    $order->item_name,
                    $order->item_price,
                    $order->quantity,
                    $order->subtotal_price,
                    $order->customer_name,
                    $order->customer_email,
                    $order->destination_name,
                    $order->destination_zip,
                    $order->destination_prefecture,
                    $order->destination_address,
                    $order->destination_tel,
                ]
            );
        }

        return $tsv->map(
                function (array $values) {
                    return implode("\t", $values);
                }
            )->implode("\n") . "\n";
    }

    private function title(): array
    {
        return [
            '구매 코드',
            '구매 날짜',
            '명세 번호',
            '제품명',
            '제품 가격',
            '구매 수량',
            '소계 금액',
            '합계 수량',
            '합계 금액',
            '구매자명',
            '구매자 메일주소',
            '배송지명',
            '배송지 우편번호',
            '배송지 시도군구',
            '배송지 주소',
            '배송지 전화번호',
        ];
    }
}
