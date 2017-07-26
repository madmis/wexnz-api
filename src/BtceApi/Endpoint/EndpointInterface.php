<?php

namespace madmis\BtceApi\Endpoint;

use madmis\BtceApi\Client\ClientInterface;

/**
 * Interface EndpointInterface
 *
 * @package madmis\BtceApi\Endpoint
 */
interface EndpointInterface
{
    /**
     * @param ClientInterface $client
     * @param array $options
     */
    public function __construct(ClientInterface $client, array $options = []);
}
