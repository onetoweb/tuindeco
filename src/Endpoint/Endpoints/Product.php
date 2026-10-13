<?php

namespace Onetoweb\Tuindeco\Endpoint\Endpoints;

use Onetoweb\Tuindeco\Endpoint\AbstractEndpoint;
use Generator;

/**
 * Product Endpoint.
 */
class Product extends AbstractEndpoint
{
    /**
     * @param array $productNumbers
     * @param array $query = []
     * 
     * @return array
     */
    public function list(array $productNumbers, array $query = []): array
    {
        $query['productNumbers'] = implode(',', $productNumbers);
        
        return $this->client->get('/products', $query);
    }
    
    /**
     * @param array $productNumbers
     * @param array $query = []
     * 
     * @return Generator
     */
    public function listAll(array $productNumbers, array $query = []): Generator
    {
        $query['page'] = 1;
        $query['limit'] = 100;
        
        do {
            
            $result = $this->list($productNumbers, $query);
            
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
    public function models(array $productNumbers, array $query = []): array
    {
        $query['productNumbers'] = implode(',', $productNumbers);
        
        return $this->client->get('/product-models', $query);
    }
    
    /**
     * @param array $productNumbers
     * @param array $query = []
     * 
     * @return Generator
     */
    public function modelsAll(array $productNumbers, array $query = []): Generator
    {
        $query['page'] = 1;
        $query['limit'] = 100;
        
        do {
            
            $result = $this->models($productNumbers, $query);
            
            foreach ($result['results'] as $model) {
                
                yield $model;
            }
            
            $query['page']++;
            
        } while($result['_meta']['hasMore']);
    }
    
    /**
     * @param array $productIds
     * @param array $query = []
     * 
     * @return array
     */
    public function configurators(array $productIds, array $query = []): array
    {
        $query['productIds'] = implode(',', $productIds);
        
        return $this->client->get('/product-models', $query);
    }
    
    /**
     * @param array $productNumbers
     * @param array $query = []
     * 
     * @return Generator
     */
    public function configuratorsAll(array $productIds, array $query = []): Generator
    {
        $query['page'] = 1;
        $query['limit'] = 100;
        
        do {
            
            $result = $this->configurators($productIds, $query);
            
            foreach ($result['results'] as $configurator) {
                
                yield $configurator;
            }
            
            $query['page']++;
            
        } while($result['_meta']['hasMore']);
    }
}
