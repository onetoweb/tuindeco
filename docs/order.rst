.. _top:
.. title:: Profile

`Back to index <index.rst>`_

=======
Profile
=======

.. contents::
    :local:


List orders
```````````

.. code-block:: php
    
    $result = $client->order->list([
        
        // optional parameters
        'language' => 'nl',
        'page' => 1,
        'limit' => 100,
        'status' => 'Open', // possible values see order statuses
        'from' => '2026-01-01',
        'to' => '2026-12-31',
    ]);


Order statuses
``````````````

* 'Open'
* 'Done'
* 'Paid'
* 'Paid In Full'
* 'Pending Approval'
* 'Pending Fulfillment'
* 'Partially Fulfilled'
* 'Fulfilled'
* 'Partially Billed'
* 'Billed'
* 'Closed'
* 'Cancelled'
* 'In Progress'
* 'Shipped (partially)'
* 'Paid (partially)'
* 'Shipped'
* 'Pending Billing'
* 'Pending Billing/Partially Fulfilled'


Create an order from line items
```````````````````````````````

.. code-block:: php
    
    $order = [
        'lineItems' => [
            [
                'productNumber' => 'SW-10001',
                'quantity' => 2,
                
                // optional parameters
                'reference' => 'LINE-REF-001'
            ]
        ],
        
        // optional parameters
        'reference' => 'ORDER-REF-123',
        'deliveryWeek' => 12,
        'shippingAddressId' => '018f3c3a-4a5e-73b3-a8d3-b1e2f3a4b5c6',
        'dropshipmentAddress' => [
            'firstName' => 'Jan',
            'lastName' => 'Janssen',
            'street' => 'Hoofdstraat 1',
            'zipCode' => '1234 AB',
            'city' => 'Amsterdam',
            'countryCode' => 'NL',
            'company' => '',
            'additionalAddressLine1' => '',
            'additionalAddressLine2' => '',
            'phoneNumber' => ''
        ]
    ];
    
    $client->order->create($order);


`Back to top <#top>`_