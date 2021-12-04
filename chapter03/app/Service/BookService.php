<?php

declare(strict_types=1);

namespace App\Service;

use App\Models\User;
use App\Book;
use App\Purchase;

/**
 * Class BookService
 * 트랜잭션 스크립트 패턴
 */
class BookService
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function order(array $books = [])
    {
        $purchases = [];
        /** @var \App\DataTransfer\Book $book */
        foreach ($books as $book) {
            // ②
            if (!$result = Book::find($book->getId())) {
                throw new \App\Exceptions\BookStockException('재고 에러');
            }
            $purchases[] = $result;
        }
        // ③
        foreach ($purchases as $purchase) {
            Purchase::create(
                [
                    'book_id' => $purchase->id,
                    'user_id' => $this->user->id,
                ]
            );
        }
        // ④
        // 포인트 추가
        // 결제 완료 메일 송신
    }
}
