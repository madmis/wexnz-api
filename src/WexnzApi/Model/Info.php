<?php

namespace madmis\WexnzApi\Model;

/**
 * Class Info
 * @package madmis\WexnzApi\Model
 */
class Info
{
    /**
     * @var \DateTime
     */
    protected $serverTime;

    /**
     * @var array|PairInfo[]
     */
    protected $pairs;

    /**
     * @return \DateTime
     */
    public function getServerTime(): \DateTime
    {
        return $this->serverTime;
    }

    /**
     * @param int $serverTime
     */
    public function setServerTime(int $serverTime): void
    {
        $this->serverTime = (new \DateTime())->setTimestamp($serverTime);
    }

    /**
     * @return array|PairInfo[]
     */
    public function getPairs(): array
    {
        return $this->pairs;
    }

    /**
     * @param array $pairs
     */
    public function setPairs(array $pairs): void
    {
        $this->pairs = $pairs;
    }
}
