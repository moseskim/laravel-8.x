<?php
declare(strict_types=1);

namespace App\Usecase;

use App\Entity\Customer;
use App\Entity\Product;
use App\Events\PublishProcessor;
use Illuminate\Events\Dispatcher;

class UserPurchasedBook
{
    const DISABLE_NOTIFICATION = 1;

    protected $dispatcher;

    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param Customer  $customer
     * @param Product[] $product
     */
    public function run(Customer $customer, array $product = [])
    {
        if ($customer->getStatus() === self::DISABLE_NOTIFICATION) {
            // or if($customer->disabledNotification()) {}
            if ($this->dispatcher->hasListeners(PublishProcessor::class)) {
                $this->dispatcher->forget(PublishProcessor::class);
            }
        }
        $this->dispatcher->dispatch(new PublishProcessor($customer->getId()));
    }
}
