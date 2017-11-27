<?php


namespace madmis\WexnzApi\Model;

/**
 * Class Depth
 * @package madmis\WexnzApi\Model
 */
class Depth
{
    /**
     * The amount of currency to be bought/sold
     * @var float
     */
    protected $amount;

    /**
     * Sell/Buy price
     * @var float
     */
    protected $rate;

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
     * amount * rate
     * @return float
     */
    public function getTotalAmount(): float
    {
        return bcmul($this->amount, $this->rate, 10);
    }
}
