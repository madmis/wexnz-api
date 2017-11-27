<?php

namespace madmis\WexnzApi\Model;

/**
 * Class UserInfo
 * @package madmis\WexnzApi\Model
 */
class UserInfo
{

    /**
     * @var array
     */
    protected $funds = [];

    /**
     * @var array
     */
    protected $rights = [];

    /**
     * @var int
     */
    protected $transactionCount;

    /**
     * @var int
     */
    protected $openOrders;

    /**
     * UNIX time of the trade.
     * @var \DateTime
     */
    protected $serverTime;

    /**
     * @return array
     */
    public function getFunds(): array
    {
        return $this->funds;
    }

    /**
     * @param array $funds
     */
    public function setFunds(array $funds): void
    {
        $this->funds = $funds;
    }

    /**
     * @return array
     */
    public function getRights(): array
    {
        return $this->rights;
    }

    /**
     * @param array $rights
     */
    public function setRights(array $rights): void
    {
        $this->rights = $rights;
    }

    /**
     * @return int
     */
    public function getTransactionCount(): int
    {
        return $this->transactionCount;
    }

    /**
     * @param int $transactionCount
     */
    public function setTransactionCount(int $transactionCount): void
    {
        $this->transactionCount = $transactionCount;
    }

    /**
     * @return int
     */
    public function getOpenOrders(): int
    {
        return $this->openOrders;
    }

    /**
     * @param int $openOrders
     */
    public function setOpenOrders(int $openOrders): void
    {
        $this->openOrders = $openOrders;
    }

    /**
     * Time of the trade
     * @return \DateTime
     */
    public function getServerTime(): \DateTime
    {
        return $this->serverTime;
    }

    /**
     * @param int $timestamp
     */
    public function setServerTime(int $timestamp): void
    {
        $this->serverTime = (new \DateTime())->setTimestamp($timestamp);
    }
}
