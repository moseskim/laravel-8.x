<?php
declare(strict_types=1);

namespace App\Events;

/**
 * Class PublishProcessor
 */
final class PublishProcessor
{
    /** @var int */
    private $int;

    /**
     * PublishProcessor constructor.
     *
     * @param int $int
     */
    public function __construct(int $int)
    {
        $this->int = $int;
    }

    /**
     * @return int
     */
    public function getInt(): int
    {
        return $this->int;
    }
}
