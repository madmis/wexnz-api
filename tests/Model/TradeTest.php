<?php

namespace Test\Model;

use madmis\BtceApi\Model\Trade;
use PHPUnit\Framework\TestCase;

/**
 * Class TradeTest
 * @package Test\Model
 */
class TradeTest extends TestCase
{
    public function testModel()
    {
        $trade = new Trade();
        $trade->setAmount(125.0);
        $trade->setPrice(84.2);
        $trade->setTid(23423423);
        $trade->setTimestamp(1370817960);
        $trade->setType('bid');

        static::assertInstanceOf(\DateTime::class, $trade->getTimestamp());
        static::assertEquals('2013-06-09 22:46:00', $trade->getTimestamp()->format('Y-m-d H:i:s'));

        static::assertEquals(125.0, $trade->getAmount());
        static::assertEquals(84.2, $trade->getPrice());
        static::assertEquals(23423423, $trade->getTid());
        static::assertEquals('bid', $trade->getType());
    }
}
