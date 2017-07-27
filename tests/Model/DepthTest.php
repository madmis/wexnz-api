<?php

namespace Test\Model;

use madmis\BtceApi\Model\Depth;
use PHPUnit\Framework\TestCase;

/**
 * Class DepthTest
 * @package Test\Model
 */
class DepthTest extends TestCase
{
    public function testModel()
    {
        $depth = new Depth();
        $depth->setAmount(2);
        $depth->setRate(10);

        static::assertEquals(2, $depth->getAmount());
        static::assertEquals(10, $depth->getRate());
        static::assertEquals(20, $depth->getTotalAmount());
    }
}
