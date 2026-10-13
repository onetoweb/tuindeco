<?php

namespace Onetoweb\Tuindeco\Endpoint;

use Onetoweb\Tuindeco\Client;

/**
 * Abstract Endpoint.
 */
abstract class AbstractEndpoint implements EndpointInterface
{
    /**
     * @param Client $client
     */
    public function __construct(
        protected Client $client
    ) {
        
    }
}
