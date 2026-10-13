.. title:: Index

Index
=====

.. contents::
    :local:

===========
Basic Usage
===========

Setup

.. code-block:: php
    
    require 'vendor/autoload.php';
    
    use Symfony\Component\HttpFoundation\Session\Session;
    use Onetoweb\Tuindeco\{Client, Token};
    
    // start session
    $session = new Session();
    $session->start();
    
    // param
    $clientId = '<client_id>';
    $clientSecret = '<client_secret>';
    
    // setup client
    $client = new Client($clientId, $clientSecret);
    
    // set token update callback
    $client->setTokenUpdateCallback(function(Token $token) use ($session) {
        
        // store token
        $session->set('token', [
            'access_token' => $token->getAccessToken(),
            'refresh_token' => $token->getRefreshToken(),
            'expires' => $token->getExpires(),
        ]);
        
    });
    
    // load token from storage
    if ($session->has('token')) {
        
        $tokenArray = $session->get('token');
        
        // build token
        $token = new Token(
            $tokenArray['access_token'],
            $tokenArray['refresh_token'],
            $tokenArray['expires']
        );
        
        // set token
        $client->setToken($token);
    }


========
Examples
========

* `Profile <profile.rst>`_
* `Assortment <assortment.rst>`_
* `Product <product.rst>`_
* `Order <order.rst>`_
