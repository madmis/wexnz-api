<?php

namespace madmis\WexnzApi\Model;

/**
 * Class TradeHistory
 * @package madmis\WexnzApi\Model
 */
class TradeHistory
{
    /**
     * @var int
     */
    protected $orderId;

    /**
     * @var string
     */
    protected $pair;

    /**
     * buy/sel
     * @var string
     */
    protected $type;

    /**
     * @var float
     */
    protected $amount;

    /**
     * @var float
     */
    protected $rate;

    /**
     * @var bool
     */
    protected $isYourOrder;

    /**
     * Last update of cache.
     * @var \DateTime
     */
    protected $timestamp;

    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->orderId;
    }

    /**
     * @param int $orderId
     */
    public function setOrderId(int $orderId): void
    {
        $this->orderId = $orderId;
    }

    /**
     * @return string
     */
    public function getPair(): string
    {
        return $this->pair;
    }

    /**
     * @param string $pair
     */
    public function setPair(string $pair): void
    {
        $this->pair = $pair;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return float
     */
    public function getRate(): float
    {
        return $this->rate;
    }

    /**
     * @param float $rate
     */
    public function setRate(float $rate): void
    {
        $this->rate = $rate;
    }

    /**
     * @return bool
     */
    public function isYourOrder(): bool
    {
        return $this->isYourOrder;
    }

    /**
     * @param bool $isYourOrder
     */
    public function setIsYourOrder(bool $isYourOrder): void
    {
        $this->isYourOrder = $isYourOrder;
    }

    /**
     * @return \DateTime
     */
    public function getTimestamp(): \DateTime
    {
        return $this->timestamp;
    }

    /**
     * @param int $timestamp
     */
    public function setTimestamp(int $timestamp): void
    {
        $this->timestamp = (new \DateTime())->setTimestamp($timestamp);
    }
}
