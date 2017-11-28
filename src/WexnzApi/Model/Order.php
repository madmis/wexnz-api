<?php

namespace madmis\WexnzApi\Model;

/**
 * Class Order
 * @package madmis\WexnzApi\Model
 */
class Order
{
    /**
     * @var string
     */
    protected $id;

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
     * Last update of cache.
     * @var \DateTime
     */
    protected $timestampCreated;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
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
     * Last update of cache
     * @return \DateTime
     */
    public function getTimestampCreated(): \DateTime
    {
        return $this->timestampCreated;
    }

    /**
     * @param int $updated
     */
    public function setTimestampCreated(int $updated): void
    {
        $this->timestampCreated = (new \DateTime())->setTimestamp($updated);
    }
}
