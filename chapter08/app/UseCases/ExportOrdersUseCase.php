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
            '구매_코드',
            '구매_날짜',
            '구매_상세_번호',
            '제품명',
            '제품_가격',
            '구매_수량',
            '소계_금액',
            '합계_수량',
            '합계_금액',
            '구매자명',
            '구매자_메일주소',
            '배송지명',
            '배송지_우편번호',
            '배송지_시도군구',
            '배송지_주소',
            '배송지_전화번호',
        ];
    }
}
