<?php

namespace Test\Model;

use madmis\WexnzApi\Model\Ticker;
use PHPUnit\Framework\TestCase;

/**
 * Class TickerTest
 * @package Test\Model
 */
class TickerTest extends TestCase
{
    public function testModel()
    {
        $ticker = new Ticker();
        $ticker->setAvg(50);
        $ticker->setBuy(1582.85);
        $ticker->setHigh(154.1);
        $ticker->setLast(18.3);
        $ticker->setLow(15.2);
        $ticker->setPair('btc_usd');
        $ticker->setSell(15748.78);
        $ticker->setUpdated(1370817960);
        $ticker->setVol(157544);
        $ticker->setVolCur(45468545456.85);

        static::assertInstanceOf(\DateTime::class, $ticker->getUpdated());
        static::assertEquals('2013-06-09 22:46:00', $ticker->getUpdated()->format('Y-m-d H:i:s'));

        static::assertEquals(50, $ticker->getAvg());
        static::assertEquals(1582.85, $ticker->getBuy());
        static::assertEquals(154.1, $ticker->getHigh());
        static::assertEquals(18.3, $ticker->getLast());
        static::assertEquals(15.2, $ticker->getLow());
        static::assertEquals('btc_usd', $ticker->getPair());
        static::assertEquals(15748.78, $ticker->getSell());
        static::assertEquals(157544, $ticker->getVol());
        static::assertEquals(45468545456.85, $ticker->getVolCur());
    }
}
