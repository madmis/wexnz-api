<?php

namespace madmis\WexnzApi\Model;

/**
 * Class CancelOrder
 * @package madmis\WexnzApi\Model
 */
class CancelOrder
{
    /**
     * @var int
     */
    protected $orderId;

    /**
     * @var array
     */
    protected $funds;

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
