<?php

namespace Database\Seeders;

use Carbon\CarbonImmutable;
use Illuminate\Database\Connection;
use Illuminate\Database\Seeder;
use Throwable;

class DatabaseSeeder extends Seeder
{
    /** @var Connection */
    private $db;

    /**
     * @param Connection $db
     */
    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Throwable
     */
    public function run()
    {
        $this->db->transaction(
            function () {
                $this->orders();
                $this->orderDetails();
            }
        );
    }

    private function orders()
    {
        $now = CarbonImmutable::now();

        $this->db->table('orders')->insert(
            [
                'order_code' => '1111-1111-1111-1111',
                'order_date' => '2021-04-10 00:00:00',
                'customer_name' => '사용자 1',
                'customer_email' => 'user1@example.com',
                'destination_name' => '배송지 사용자 1',
                'destination_zip' => '10001',
                'destination_prefecture' => '서울',
                'destination_address' => '배송지 주소 1',
                'destination_tel' => '010-1234-2345',
                'total_quantity' => 1,
                'total_price' => 1000,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );
        $this->db->table('orders')->insert(
            [
                'order_code' => '1111-1111-1111-1112',
                'order_date' => '2021-04-10 23:59:59',
                'customer_name' => '사용자 2',
                'customer_email' => 'user2@example.com',
                'destination_name' => '배송지 사용자 2',
                'destination_zip' => '10002',
                'destination_prefecture' => '경기',
                'destination_address' => '배송지 주소 2',
                'destination_tel' => '010-2345-3456',
                'total_quantity' => 3,
                'total_price' => 2500,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        $this->db->table('orders')->insert(
            [
                'order_code' => '1111-1111-1111-1113',
                'order_date' => '2021-04-11 00:00:00',
                'customer_name' => '사용자 3',
                'customer_email' => 'user3@example.com',
                'destination_name' => '배송지 사용자 3',
                'destination_zip' => '10003',
                'destination_prefecture' => '부산',
                'destination_address' => '배송지 주소 3',
                'destination_tel' => '010-3456-4567',
                'total_quantity' => 1,
                'total_price' => 2000,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );
    }

    private function orderDetails()
    {
        $this->db->table('order_details')->insert(
            [
                'order_code' => '1111-1111-1111-1111',
                'detail_no' => 1,
                'item_name' => '제품 1',
                'item_price' => 1000,
                'quantity' => 1,
                'subtotal_price' => 1000,
            ]
        );

        $this->db->table('order_details')->insert(
            [
                'order_code' => '1111-1111-1111-1112',
                'detail_no' => 1,
                'item_name' => '제품 1',
                'item_price' => 1000,
                'quantity' => 2,
                'subtotal_price' => 2000,
            ]
        );
        $this->db->table('order_details')->insert(
            [
                'order_code' => '1111-1111-1111-1112',
                'detail_no' => 2,
                'item_name' => '제품 2',
                'item_price' => 500,
                'quantity' => 1,
                'subtotal_price' => 500,
            ]
        );

        $this->db->table('order_details')->insert(
            [
                'order_code' => '1111-1111-1111-1113',
                'detail_no' => 1,
                'item_name' => '제품 3',
                'item_price' => 2000,
                'quantity' => 1,
                'subtotal_price' => 2000,
            ]
        );
    }

}
