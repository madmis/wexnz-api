<?php

namespace Test\Endpoint;

use madmis\WexnzApi\Endpoint\TradeEndpoint;
use madmis\ExchangeApi\Client\GuzzleClient;
use PHPUnit\Framework\TestCase;

/**
 * Class TradeEndpointTest
 * @package Test\Endpoint
 */
class TradeEndpointTest extends TestCase
{
    /**
     * @expectedException \Symfony\Component\OptionsResolver\Exception\MissingOptionsException
     */
    public function testNoOptions()
    {
        $client = new \madmis\ExchangeApi\Client\GuzzleClient('', '', []);

        new TradeEndpoint($client);
    }

    /**
     * @expectedException \Symfony\Component\OptionsResolver\Exception\InvalidOptionsException
     */
    public function testInvalidTypeOption()
    {
        $client = new GuzzleClient('', '', []);

        new TradeEndpoint($client, ['publicKey' => '', 'secretKey' => null]);
    }

}