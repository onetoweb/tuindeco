<?php

namespace Onetoweb\Tuindeco;

use Onetoweb\Tuindeco\Endpoint\Endpoints;
use Onetoweb\Tuindeco\Config\{Method, Url};
use Onetoweb\Tuindeco\Token;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Client as GuzzleCLient;
use DateTime;
use Closure;

/**
 * Tuindeco Api Client.
 */
#[\AllowDynamicProperties]
class Client
{
    /**
     * Base href
     */
    public const BASE_HREF = 'https://tuindeco.com/customer-api';
    
    /**
     * Version
     */
    public const VERSION = 1;
    
    /**
     * @var Closure|null
     */
    private ?Closure $tokenUpdateCallback = null;
    
    /**
     * @var Token|null
     */
    private ?Token $token = null;
    
    /**
     * @param string $clientId
     * @param string $clientSecret
     * @param int $version
     */
    public function __construct(
        
        #[\SensitiveParameter]
        private string $clientId,
        
        #[\SensitiveParameter]
        private string $clientSecret,
        
        private int $version = self::VERSION
    ) {
        // load endpoints
        $this->loadEndpoints();
    }
    
    /**
     * @return void
     */
    private function loadEndpoints(): void
    {
        foreach (Endpoints::list() as $name => $class) {
            $this->{$name} = new $class($this);
        }
    }
    
    /**
     * @param Closure $tokenUpdateCallback
     * 
     * @return void
     */
    public function setTokenUpdateCallback(Closure $tokenUpdateCallback): void
    {
        $this->tokenUpdateCallback = $tokenUpdateCallback;
    }
    
    /**
     * @param Token $token
     * 
     * @return void
     */
    public function setToken(Token $token): void
    {
        $this->token = $token;
    }
    
    /**
     * @param string $endpoint
     * 
     * @return string
     */
    public function getUrl(string $endpoint): string
    {
        return implode('/', [
            self::BASE_HREF,
            "v{$this->version}",
            ltrim($endpoint, '/')
        ]);
    }
    
    /**
     * @param string $endpoint
     * @param array $query = []
     * 
     * @return array
     */
    public function get(string $endpoint, array $query = []): array
    {
        return $this->request(Method::GET, $endpoint, [], $query);
    }
    
    /**
     * @param string $endpoint
     * @param array $data = []
     * 
     * @return array
     */
    public function post(string $endpoint, array $data = []): array
    {
        return $this->request(Method::POST, $endpoint, $data);
    }
    
    /**
     * @param string $endpoint
     * @param array $data = []
     * 
     * @return array
     */
    public function put(string $endpoint, array $data = []): array
    {
        return $this->request(Method::PUT, $endpoint, $data);
    }
    
    /**
     * @param string $endpoint
     * @param array $data = []
     * 
     * @return array
     */
    public function patch(string $endpoint, array $data = []): array
    {
        return $this->request(Method::PATCH, $endpoint, $data);
    }
    
    /**
     * @param string $endpoint
     * 
     * @return array
     */
    public function delete(string $endpoint): array
    {
        return $this->request(Method::DELETE, $endpoint);
    }
    
    /**
     * @return void
     */
    public function getAccessToken(): void
    {
        // build json
        if (
            $this->token === null
            or $this->token->getRefreshToken() === null
        ) {
            
            $json = [
                'grant_type' => 'client_credentials',
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret
            ];
            
        } else {
            
            $json = [
                'grant_type' => 'refresh_token',
                'refresh_token' => $this->token->getRefreshToken()
            ];
        }
        
        // build options
        $options = [
            RequestOptions::HEADERS => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            RequestOptions::JSON => $json
        ];
        
        // make request
        $response = (new GuzzleCLient())->post(self::BASE_HREF . '/oauth/token', $options);
        
        // get contents
        $contents = $response->getBody()->getContents();
        
        // decode json
        $tokenArray = json_decode($contents, true);
        
        // get expires in
        $expiresIn = ($tokenArray['expires_in'] - 10);
        
        // get expires
        $expires = (new DateTime())->modify("+$expiresIn seconds");
        
        // build token
        $this->token = new Token(
            $tokenArray['access_token'],
            $tokenArray['refresh_token'],
            $expires
        );
        
        // token update callback
        if ($this->tokenUpdateCallback !== null) {
            ($this->tokenUpdateCallback)($this->token);
        }
    }
    
    /**
     * @param Method $method
     * @param string $endpoint
     * @param array $data = []
     * @param array $query = []
     * 
     * @return array|null
     */
    public function request(Method $method, string $endpoint, array $data = [], array $query = []): array|null
    {
        // check token
        if (
            $this->token === null
            or $this->token->isExpired()
        ) {
            // authenticate
            $this->getAccessToken();
        }
        
        // build options
        $options = [
            RequestOptions::HEADERS => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => "Bearer {$this->token}",
            ],
            RequestOptions::QUERY => $query
        ];
        
        if (count($data) > 0) {
            $options[RequestOptions::JSON] = $data;
        }
        
        // make request
        $response = (new GuzzleCLient())->request($method->value, $this->getUrl($endpoint), $options);
        
        // get Contents
        $contents = $response->getBody()->getContents();
        
        // decode json
        $json = json_decode($contents, true);
        
        return $json;
    }
}
