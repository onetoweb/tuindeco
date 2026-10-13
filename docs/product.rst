.. _top:
.. title:: Product

`Back to index <index.rst>`_

=======
Product
=======

.. contents::
    :local:


List products
`````````````

.. code-block:: php
    
    $productNumbers = [
        'SW-10001',
        'SW-10002'
    ];
    $result = $client->product->list($productNumbers, [
        
        // optional parameters
        'language' => 'nl',
        'page' => 1,
        'limit' => 100
    ]);


List all products
`````````````````

Yields all product using multiple request with the generator syntax.

.. code-block:: php
    
    $productNumbers = [
        'SW-10001',
        'SW-10002'
    ];
    $productGenerator = $client->product->listAll($productNumbers, [
        
        // optional parameters
        'language' => 'nl',
    ]);
    foreach ($productGenerator as $product) {
        
        $product;
    }


Get product models
``````````````````

.. code-block:: php
    
    $productNumbers = [
        'SW-10001',
        'SW-10002'
    ];
    $result = $client->product->models($productNumbers, [
        
        // optional parameters
        'language' => 'nl',
        'page' => 1,
        'limit' => 100
    ]);


Get all product models
``````````````````````

Yields all product models using multiple request with the generator syntax.

.. code-block:: php
    
    $productNumbers = [
        'SW-10001',
        'SW-10002'
    ];
    $productModelGenerator = $client->product->modelsAll($productNumbers, [
        
        // optional parameters
        'language' => 'nl',
    ]);
    foreach ($productModelGenerator as $productModel) {
        
        $productModel;
    }


Get product configurators
`````````````````````````

.. code-block:: php
    
    $productIds = [
        'e1aad7c3052a443bb1c0e081fffb9dd5',
        'fc6d36cca5fd46738d76e82509525148'
    ];
    $result = $client->product->configurators($productIds, [
        
        // optional parameters
        'language' => 'nl',
        'page' => 1,
        'limit' => 100
    ]);


Get all product configurators
`````````````````````````````

Yields all product configurators using multiple request with the generator syntax.

.. code-block:: php
    
    $productIds = [
        'e1aad7c3052a443bb1c0e081fffb9dd5',
        'fc6d36cca5fd46738d76e82509525148'
    ];
    $configuratorGenerator = $client->product->configuratorsAll($productIds, [
        
        // optional parameters
        'language' => 'nl',
    ]);
    
    foreach ($configuratorGenerator as $configurator) {
        
        $configurator;
    }


`Back to top <#top>`_