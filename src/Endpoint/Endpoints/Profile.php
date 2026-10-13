<?php

namespace Onetoweb\Tuindeco\Endpoint\Endpoints;

use Onetoweb\Tuindeco\Endpoint\AbstractEndpoint;

/**
 * Profile Endpoint.
 */
class Profile extends AbstractEndpoint
{
    /**
     * @param array $query = []
     * 
     * @return array
     */
    public function get(array $query = []): array
    {
        return $this->client->get('/profile', $query);
    }
}
