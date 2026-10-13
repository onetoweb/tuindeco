.. _top:
.. title:: Assortment

`Back to index <index.rst>`_

==========
Assortment
==========

.. contents::
    :local:


List assortment product numbers
```````````````````````````````

.. code-block:: php
    
    $result = $client->assortment->list([
        
        // optional parameters
        'language' => 'nl',
        'page' => 1,
        'limit' => 100
    ]);


List all assortment product numbers
```````````````````````````````````

Yields all product numbers using multiple request with the generator syntax.

.. code-block:: php
    
    $productNumberGenerator = $client->assortment->listAll([
        
        // optional parameters
        'language' => 'nl',
    ]);
    
    foreach ($productNumberGenerator as $productNumber) {
        
        $productNumber;
    }


Lookup prices by product numbers
````````````````````````````````

.. code-block:: php
    
    $productNumbers = [
        'SW-10001',
        'SW-10002'
    ];
    $result = $client->assortment->price($productNumbers, [
        
        // optional parameters
        'language' => 'nl',
        'page' => 1,
        'limit' => 100
    ]);


Lookup all prices by product numbers
````````````````````````````````

Yields all product price data using multiple request with the generator syntax.

.. code-block:: php
    
    $productNumbers = [
        'SW-10001',
        'SW-10002'
    ];
    $productPriceGenerator = $client->assortment->priceAll($productNumbers, [
        
        // optional parameters
        'language' => 'nl',
    ]);
    foreach ($productPriceGenerator as $productPrice) {
        
        $productPrice;
    }


Lookup stock by product numbers
```````````````````````````````

.. code-block:: php
    
    $productNumbers = [
        'SW-10001',
        'SW-10002'
    ];
    $result = $client->assortment->stock($productNumbers, [
        
        // optional parameters
        'language' => 'nl',
        'page' => 1,
        'limit' => 100
    ]);


Lookup all stock by product numbers
```````````````````````````````````

Yields all product stock data using multiple request with the generator syntax.

.. code-block:: php
    
    $productNumbers = [
        'SW-10001',
        'SW-10002'
    ];
    $productStockGenerator = $client->assortment->stockAll($productNumbers, [
        
        // optional parameters
        'language' => 'nl',
    ]);
    foreach ($productStockGenerator as $productNumber => $stock) {
        
        $productNumber;
        $stock;
    }


`Back to top <#top>`_