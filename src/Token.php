<?php

namespace Onetoweb\Tuindeco;

use DateTime;

/**
 * Tuindeco Api Token.
 */
class Token
{
    /**
     * @param string $value
     * @param DateTime $expires
     */
    public function __construct(
        
        #[\SensitiveParameter]
        private string $accessToken,
        
        #[\SensitiveParameter]
        private string $refreshToken,
        
        private DateTime $expires
    ) {
        
    }
    
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->accessToken;
    }
    
    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }
    
    /**
     * @return string
     */
    public function getRefreshToken(): string
    {
        return $this->refreshToken;
    }
    
    /**
     * @return string
     */
    public function getExpires(): DateTime
    {
        return $this->expires;
    }
    
    /**
     * @return bool
     */
    public function isExpired(): bool
    {
        return (bool) ($this->expires < new DateTime());
    }
}
