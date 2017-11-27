<?php

namespace madmis\WexnzApi\Model;

/**
 * Class Trade
 * @package madmis\WexnzApi\Model
 */
class Trade
{
    /**
     * ask – Sell, bid – Buy.
     * @var string
     */
    protected $type;

    /**
     * Buy price/Sell price.
     * @var float
     */
    protected $price;

    /**
     * The amount of asset bought/sold.
     * @var float
     */
    protected $amount;

    /**
     * Trade ID
     * @var int
     */
    protected $tid;

    /**
     * UNIX time of the trade.
     * @var \DateTime
     */
    protected $timestamp;

    /**
     * ask – Sell, bid – Buy.
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
     * Buy price/Sell price.
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * The amount of asset bought/sold.
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
     * Trade ID
     * @return int
     */
    public function getTid(): int
    {
        return $this->tid;
    }

    /**
     * @param int $tid
     */
    public function setTid(int $tid): void
    {
        $this->tid = $tid;
    }

    /**
     * Time of the trade
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
