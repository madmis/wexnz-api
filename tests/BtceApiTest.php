<?php

namespace Test;

use GuzzleHttp\Client;
use madmis\BtceApi\BtceApi;
use madmis\BtceApi\Endpoint\PublicEndpoint;
use madmis\BtceApi\Endpoint\TradeEndpoint;
use madmis\ExchangeApi\Client\ClientInterface;
use madmis\ExchangeApi\Client\GuzzleClient;
use PHPUnit\Framework\TestCase;

/**
 * Class BtceApiTest
 * @package Test
 */
class BtceApiTest extends TestCase
{
    /**
     * @expectedException \TypeError
     */
    public function testSetClient()
    {
        $api = new BtceApi('http://localhost', 'pub', 'sec');

        $api->setClient(new Client([]));
    }

    public function testGetClient()
    {
        $api = new BtceApi('http://localhost', 'pub', 'sec');

        $this->assertInstanceOf(
            GuzzleClient::class,
            $api->getClient()
        );

        $mock = $this->createMock(ClientInterface::class);
        $api->setClient($mock);
        $this->assertInstanceOf(
            ClientInterface::class,
            $api->getClient()
        );
    }

    public function testGetShared()
    {
        $api = new BtceApi('http://localhost', 'pub', 'sec');

        $this->assertInstanceOf(
            PublicEndpoint::class,
            $api->shared()
        );
    }

    public function testGetTrade()
    {
        $api = new BtceApi('http://localhost', 'pub', 'sec');

        $this->assertInstanceOf(
            TradeEndpoint::class,
            $api->trade()
        );
    }
}
