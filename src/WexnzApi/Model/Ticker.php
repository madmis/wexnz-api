<?php

namespace madmis\WexnzApi\Model;

/**
 * Class Ticker
 * @package madmis\WexnzApi\Model
 */
class Ticker
{
    /**
     * @var string
     */
    protected $pair;

    /**
     * Maximum price over the past 24 hours
     * @var float
     */
    protected $high;

    /**
     * Minimum price over the past 24 hours
     * @var float
     */
    protected $low;

    /**
     * Average price over the past 24 hours
     * @var float
     */
    protected $avg;

    /**
     * Trade volume over the past 24 hours
     * @var float
     */
    protected $vol;

    /**
     * Trade volume in currency over the past 24 hours
     * @var float
     */
    protected $volCur;

    /**
     * The price of the last trade
     * @var float
     */
    protected $last;

    /**
     * Last buy price
     * @var float
     */
    protected $buy;

    /**
     * Last sell price
     * @var float
     */
    protected $sell;

    /**
     * Last update of cache.
     * @var \DateTime
     */
    protected $updated;

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
     * Maximum price over the past 24 hours
     * @return float
     */
    public function getHigh(): float
    {
        return $this->high;
    }

    /**
     * @param float $high
     */
    public function setHigh(float $high): void
    {
        $this->high = $high;
    }

    /**
     * Minimum price over the past 24 hours
     * @return float
     */
    public function getLow(): float
    {
        return $this->low;
    }

    /**
     * @param float $low
     */
    public function setLow(float $low): void
    {
        $this->low = $low;
    }

    /**
     * Average price over the past 24 hours
     * @return float
     */
    public function getAvg(): float
    {
        return $this->avg;
    }

    /**
     * @param float $avg
     */
    public function setAvg(float $avg): void
    {
        $this->avg = $avg;
    }

    /**
     * Trade volume over the past 24 hours
     * @return float
     */
    public function getVol(): float
    {
        return $this->vol;
    }

    /**
     * @param float $vol
     */
    public function setVol(float $vol): void
    {
        $this->vol = $vol;
    }

    /**
     * Trade volume in currency over the past 24 hours
     * @return float
     */
    public function getVolCur(): float
    {
        return $this->volCur;
    }

    /**
     * @param float $volCur
     */
    public function setVolCur(float $volCur): void
    {
        $this->volCur = $volCur;
    }

    /**
     * The price of the last trade
     * @return float
     */
    public function getLast(): float
    {
        return $this->last;
    }

    /**
     * @param float $last
     */
    public function setLast(float $last): void
    {
        $this->last = $last;
    }

    /**
     * Last buy price
     * @return float
     */
    public function getBuy(): float
    {
        return $this->buy;
    }

    /**
     * @param float $buy
     */
    public function setBuy(float $buy): void
    {
        $this->buy = $buy;
    }

    /**
     * Last sell price
     * @return float
     */
    public function getSell(): float
    {
        return $this->sell;
    }

    /**
     * @param float $sell
     */
    public function setSell(float $sell): void
    {
        $this->sell = $sell;
    }

    /**
     * Last update of cache
     * @return \DateTime
     */
    public function getUpdated(): \DateTime
    {
        return $this->updated;
    }

    /**
     * @param int $updated
     */
    public function setUpdated(int $updated): void
    {
        $this->updated = (new \DateTime())->setTimestamp($updated);
    }
}
