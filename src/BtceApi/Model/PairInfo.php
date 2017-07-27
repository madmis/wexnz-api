<?php

namespace madmis\BtceApi\Model;

/**
 * Class PairInfo
 * @package madmis\BtceApi\Model
 */
class PairInfo
{
    /**
     * @var string
     */
    protected $pair;

    /**
     * Number of decimals allowed during trading.
     * @var int
     */
    protected $decimalPlaces;

    /**
     * Minimum price allowed during trading.
     * @var float
     */
    protected $minPrice;

    /**
     * Maximum price allowed during trading.
     * @var float
     */
    protected $maxPrice;

    /**
     * Minimum sell/buy transaction size.
     * @var float
     */
    protected $minAmount;

    /**
     * Commission for this pair.
     * @var float
     */
    protected $fee;

    /**
     * Whether the pair is hidden
     * @var bool
     */
    protected $hidden;

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
     * Number of decimals allowed during trading.
     * @return int
     */
    public function getDecimalPlaces(): int
    {
        return $this->decimalPlaces;
    }

    /**
     * @param int $decimalPlaces
     */
    public function setDecimalPlaces(int $decimalPlaces): void
    {
        $this->decimalPlaces = $decimalPlaces;
    }

    /**
     * Minimum price allowed during trading.
     * @return float
     */
    public function getMinPrice(): float
    {
        return $this->minPrice;
    }

    /**
     * @param float $minPrice
     */
    public function setMinPrice(float $minPrice): void
    {
        $this->minPrice = $minPrice;
    }

    /**
     * Maximum price allowed during trading.
     * @return float
     */
    public function getMaxPrice(): float
    {
        return $this->maxPrice;
    }

    /**
     * @param float $maxPrice
     */
    public function setMaxPrice(float $maxPrice): void
    {
        $this->maxPrice = $maxPrice;
    }

    /**
     * Minimum sell/buy transaction size.
     * @return float
     */
    public function getMinAmount(): float
    {
        return $this->minAmount;
    }

    /**
     * @param float $minAmount
     */
    public function setMinAmount(float $minAmount): void
    {
        $this->minAmount = $minAmount;
    }

    /**
     * Commission for this pair.
     * @return float
     */
    public function getFee(): float
    {
        return $this->fee;
    }

    /**
     * @param float $fee
     */
    public function setFee(float $fee): void
    {
        $this->fee = $fee;
    }

    /**
     * Whether the pair is hidden
     * @return bool
     */
    public function isHidden(): bool
    {
        return $this->hidden;
    }

    /**
     * @param int|bool $hidden
     */
    public function setHidden(int $hidden): void
    {
        $this->hidden = (bool)$hidden;
    }
}
