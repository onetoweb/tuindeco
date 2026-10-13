<?php

namespace Onetoweb\Tuindeco\Endpoint\Endpoints;

use Onetoweb\Tuindeco\Endpoint\AbstractEndpoint;

/**
 * Order Endpoint.
 */
class Order extends AbstractEndpoint
{
    /**
     * @param array $query = []
     * 
     * @return array
     */
    public function list(array $query = []): array
    {
        return $this->client->get('/orders', $query);
    }
    
    /**
     * @param array $data
     * 
     * @return array|null
     */
    public function create(array $data): array|null
    {
        return $this->client->post('/orders', $data);
    }
}
