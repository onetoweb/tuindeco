<?php

namespace Onetoweb\Tuindeco\Endpoint\Endpoints;

use Onetoweb\Tuindeco\Endpoint\AbstractEndpoint;
use Generator;

/**
 * Assortment Endpoint.
 */
class Assortment extends AbstractEndpoint
{
    /**
     * @param array $query = []
     * 
     * @return array
     */
    public function list(array $query = []): array
    {
        return $this->client->get('/assortment', $query);
    }
    
    /**
     * @param array $query = []
     * 
     * @return Generator
     */
    public function listAll(array $query = []): Generator
    {
        $query['page'] = 1;
        $query['limit'] = 100;
        
        do {
            
            $result = $this->list($query);
            
            foreach ($result['results'] as $productNumber) {
                
                yield $productNumber;
            }
            
            $query['page']++;
            
        } while($result['_meta']['hasMore']);
    }
    
    /**
     * @param array $productNumbers
     * @param array $query = []
     * 
     * @return array
     */
    public function price(array $productNumbers, array $query = []): array
    {
        $query['productNumbers'] = implode(',', $productNumbers);
        
        return $this->client->get('/price', $query);
    }
    
    /**
     * @param array $productNumbers
     * @param array $query = []
     * 
     * @return Generator
     */
    public function priceAll(array $productNumbers, array $query = []): Generator
    {
        $query['page'] = 1;
        $query['limit'] = 100;
        
        do {
            
            $result = $this->price($productNumbers, $query);
            
            foreach ($result['results'] as $product) {
                
                yield $product;
            }
            
            $query['page']++;
            
        } while($result['_meta']['hasMore']);
    }
    
    /**
     * @param array $productNumbers
     * @param array $query = []
     * 
     * @return array
     */
    public function stock(array $productNumbers, array $query = []): array
    {
        $query['productNumbers'] = implode(',', $productNumbers);
        
        return $this->client->get('/stock', $query);
    }
    
    /**
     * @param array $productNumbers
     * @param array $query = []
     * 
     * @return Generator
     */
    public function stockAll(array $productNumbers, array $query = []): Generator
    {
        $query['page'] = 1;
        $query['limit'] = 100;
        
        do {
            
            $result = $this->stock($productNumbers, $query);
            
            foreach ($result['results'] as $productNumber => $stock) {
                
                yield $productNumber => $stock['stock'];
            }
            
            $query['page']++;
            
        } while($result['_meta']['hasMore']);
    }
}
