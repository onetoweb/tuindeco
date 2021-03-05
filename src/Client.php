<?php

namespace Onetoweb\Tuindeco;

/**
 * Tuindeco Api Client.
 * 
 * @author Jonathan van 't Ende <jvantende@onetoweb.nl>
 * @copyright Onetoweb B.V.
 */
class Client
{
    /**
     * @var string
     */
    private $apiKey;
    
    /**
     * @var string
     */
    private $secret;
    
    /**
     * @param string $apiKey
     * @param string $secret
     */
    public function __construct(string $apiKey, string $secret)
    {
        $this->apiKey = $apiKey;
        $this->secret = $secret;
    }
    
    /**
     * Get products.
     * 
     * @return \stdClass
     */
    public function getProducts(): \stdClass
    {
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://feed.tuindeco.shop/versions/1.1/json/full/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => ['apikey' => $this->apiKey,'secret' => $this->secret],
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        return json_decode($response, true);
    }
    
    /**
     * Create Order.
     * 
     * @param array $order
     * 
     * @return \stdClass
     */
    public function createOrder(array $order): \stdClass
    {
        $order['apikey'] = $this->apiKey;
        $order['secret'] = $this->secret;
        
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.tuindeco.shop/v1/order/create/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $order,
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        return json_decode($response);
    }
}
