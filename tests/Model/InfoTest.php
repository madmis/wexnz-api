<?php

namespace Test\Model;

use madmis\BtceApi\Model\Info;
use madmis\BtceApi\Model\PairInfo;
use PHPUnit\Framework\TestCase;

/**
 * Class InfoTest
 * @package Test\Model
 */
class InfoTest extends TestCase
{
    public function testModel()
    {
        $pairInfo = new PairInfo();
        $pairInfo->setDecimalPlaces(3);
        $pairInfo->setFee(0.25);
        $pairInfo->setHidden(false);
        $pairInfo->setMaxPrice(1000);
        $pairInfo->setMinAmount(0.001);
        $pairInfo->setMinPrice(10);
        $pairInfo->setPair('btc_usd');

        $pairInfo2 = clone $pairInfo;
        $pairInfo2->setPair('eth_usd');

        $info = new Info();
        $info->setServerTime(1370817960);
        $info->setPairs([
            $pairInfo,
            $pairInfo2,
        ]);

        static::assertInstanceOf(\DateTime::class, $info->getServerTime());
        static::assertEquals('2013-06-09 22:46:00', $info->getServerTime()->format('Y-m-d H:i:s'));

        static::assertCount(2, $info->getPairs());
        static::assertEquals('eth_usd', $info->getPairs()[1]->getPair());
        static::assertEquals('btc_usd', $info->getPairs()[0]->getPair());
        static::assertEquals(10, $info->getPairs()[0]->getMinPrice());
        static::assertEquals(0.001, $info->getPairs()[0]->getMinAmount());
        static::assertEquals(1000, $info->getPairs()[0]->getMaxPrice());
        static::assertEquals(false, $info->getPairs()[0]->isHidden());
        static::assertEquals(0.25, $info->getPairs()[0]->getFee());
        static::assertEquals(3, $info->getPairs()[0]->getDecimalPlaces());
    }
}
