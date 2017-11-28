<?php

namespace madmis\WexnzApi\Model;

/**
 * Class NewOrder
 * @package madmis\WexnzApi\Model
 */
class NewOrder
{

    /**
     * The amount of asset was bought/sold.
     * @var float
     */
    protected $received;

    /**
     * The amount of asset bought/sold.
     * @var float
     */
    protected $remains;

    /**
     * @var int
     */
    protected $orderId;

    /**
     * @var array
     */
    protected $funds;

    /**
     * @return float
     */
    public function getReceived(): float
    {
        return $this->received;
    }

    /**
     * @param float $received
     */
    public function setReceived(float $received): void
    {
        $this->received = $received;
    }

    /**
     * @return float
     */
    public function getRemains(): float
    {
        return $this->remains;
    }

    /**
     * @param float $remains
     */
    public function setRemains(float $remains): void
    {
        $this->remains = $remains;
    }

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
}
