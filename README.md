# DHL business shipping

An unofficial library for the DHL business shipping soap API (Version 3.1) written in PHP. 

[![api version](https://img.shields.io/badge/shipping%20api%20version-3.2.0-yellow)](https://entwickler.dhl.de/en/group/ep/gesch%C3%A4ftskundenversand-3.2)
[![api version](https://img.shields.io/badge/tracking%20api%20version-1.0-yellow)](https://entwickler.dhl.de/en/group/ep/wsapis/sendungsverfolgung)
![PHP version](https://img.shields.io/badge/php->=5.6-blue)
[![Build Status](https://travis-ci.com/christoph-schaeffer/dhl-business-shipping.svg?branch=develop)](https://travis-ci.com/github/christoph-schaeffer/dhl-business-shipping/builds)
![Coverage](https://img.shields.io/badge/coverage-96.89%25-green)
[![License](https://img.shields.io/github/license/christoph-schaeffer/dhl-business-shipping)](http://badges.mit-license.org)

## Features
This library provides access to functions provided by the official dhl business shipping soap api in an object oriented way. 

Since version 3.2 this library also includes the DHL shipment tracking api to obtain tracking data of sent shipments.

These functions are:
- Create, delete and update shipment labels
- Generate export documents
- Check if shipment data is valid
- Download reports of a given date as a pdf file

Additional functions this library provides:
- Mapping the returned status messages to objects instead of just returning strings
- Seperation of street name and street/house number. However this is experimental.
- Country code to country name conversion
- PHPunit testing of internal functions
- A detailed [documentation](https://christoph-schaeffer.de/dhl-business-shipping/documentation/3-0) page


Since version 3.2 this library also includes the DHL shipment tracking api to obtain tracking data of sent shipments.

This introduced the following new features:
- Obtain tracking data of sent shipments
- Download signature images of signed shipments

## Getting started
### Technical Requirements
- PHP 5.6=<
- [PHP soap extension](https://www.php.net/manual/en/book.soap.php)
- [Composer](https://getcomposer.org)
### Authentication Requirements
- [DHL developer account](https://entwickler.dhl.de)
- To get an API key login to your DHL developer account and register your application [here](https://entwickler.dhl.de/group/ep/myapps). 
For production mode you will also have to request approval of your application by DHL.
- [DHL business customer account](https://www.dhl-geschaeftskundenportal.de/webcenter/portal/gkpExternal), which is essentially the live account a user will login and order shipment labels with.
### Installation
Add this repository to your composer.json requirements manually or navigate to your repository and enter the following command:
```
composer require christoph-schaeffer/dhl-business-shipping
```
### Usage
There are 3 client classes in this library ShippingClient, TrackingClient and MultiClient. The MultiClient combines both
Clients into one, which usually is what you want. Thus we use it as the base example. The authentication credentials are
stored in 2 classes. One for the business shipping api and one for the tracking api. These 2 APIs are not the same and
need different parameter for authentication.

Create a shipping client credentials object and fill it with your credentials.
```
use ChristophSchaeffer\Dhl\BusinessShipping\Credentials\ShippingClientCredentials; // Autoload the ShippingClientCredentials class

$shippingClientCredentials = new ShippingClientCredentials(
    'appID',        // In sandbox mode this is your developer ID.
    'apiToken',     // In sandbox mode this is your developer account password.
    'login',        // DHL business customer account name. This is optional and defaults to 2222222222_01 (sandbox)
    'password',     // DHL business customer password. This is optional and defaults to pass (sandbox)
);
```
Create a tracking client credentials object and fill it with your credentials.
```
use ChristophSchaeffer\Dhl\BusinessShipping\Credentials\TrackingClientCredentials; // Autoload the ShippingClientCredentials class

$trackingClientCredentials = new TrackingClientCredentials(
    'appID',        // In sandbox mode this is your developer ID.
    'apiToken',     // In sandbox mode this is your developer account password.
    'ztToken',      // DHL business customer ZT Token. This is optional and defaults to zt12345 (sandbox)
    'password',     // DHL business customer ZT Token password. This is optional and defaults to geheim (sandbox)
);
```
Create a client object and fill it with your credentials.
```
use ChristophSchaeffer\Dhl\BusinessShipping\MultiClient; // Autoload the Client class

$client = new MultiClient(
    $shippingClientCredentials
    $trackingClientCredentials
    TRUE,                              // isSandbox
    MultiClient::LANGUAGE_LOCALE_ENGLISH_GB // Set the status message language to english(default is german).
);
```
### Usage for the shipping api (shipment label creation)
The following is a simple example usage of the createShipmentOrder function. 
However please keep in mind that there is a lot of additional functionality. 
For more details or examples of other functions please read the [documentation](https://christoph-schaeffer.de/dhl-business-shipping/documentation/3-0).


Create a new shipment order for each shipment you want to send.
```
$shipmentOrder = new \ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder();
```
Set the shipment details.
```
$shipmentOrder->Shipment->ShipmentDetails->product = 'V01PAK'; // V01PAK = National package
$shipmentOrder->Shipment->ShipmentDetails->accountNumber = '22222222220101'; // DHL bussiness customer account number
$shipmentOrder->Shipment->ShipmentDetails->ShipmentItem->weightInKG = 1.2; // The weight including packaging
$shipmentOrder->Shipment->ShipmentDetails->shipmentDate = '2020-12-08'; // The shipping date. Must not be in the past
```
Set the shippers address in case the shipment can't be delivered it will be returned to that address.
```
$shipmentOrder->Shipment->Shipper->Name->name1 = 'DHL Paket GmbH';
$shipmentOrder->Shipment->Shipper->Address->streetName = 'Sträßchensweg';
$shipmentOrder->Shipment->Shipper->Address->streetNumber = '10';
$shipmentOrder->Shipment->Shipper->Address->zip = '53113';
$shipmentOrder->Shipment->Shipper->Address->city = 'Bonn';
$shipmentOrder->Shipment->Shipper->Address->Origin->countryISOCode = 'DE';
```
Set the receivers address.
```
$shipmentOrder->Shipment->Receiver->name1 = 'DHL Paket GmbH';
$shipmentOrder->Shipment->Receiver->Address->streetName = 'Charles-de-Gaulle-Str.';
$shipmentOrder->Shipment->Receiver->Address->streetNumber = '20';
$shipmentOrder->Shipment->Receiver->Address->zip = '53113';
$shipmentOrder->Shipment->Receiver->Address->city = 'Bonn';
$shipmentOrder->Shipment->Receiver->Address->Origin->countryISOCode = 'DE';
```
Add up to 30 shipment orders into an array.
```
$shipmentOrders = [$shipmentOrder]; // It is possible to send up to 30 shipment orders in one request.
```
Set up the request object, call the createShipmentOrder function and get its response.
```
$request = new \ChristophSchaeffer\Dhl\BusinessShipping\Request\Shipping\createShipmentOrder($shipmentOrders);
$response = $client->createShipmentOrder($request);
```
To check if the request was successful use the hasNoErrors function. If the request itself or any of the creation state objects have errors you can display their messages.
```
if($response->hasNoErrors()): // checks if any error status messages have been returned.
    echo 'Success!';
    foreach($response->CreationStates as $creationState):
        echo 'shipment number: '. $creationState->shipmentNumber;
        echo 'shipment label url:'.$creationState->LabelData->labelUrl; // When the label response type is url
        echo 'shipment label data:'.$creationState->LabelData->labelData; // When the label response type is base64 or ZPL2
    endforeach;
else:
    echo 'An error occured!\n';

    foreach($response->Status as $status): // echo all response status messages.
        echo '\n- '.$status->message;
    endforeach;

    foreach($response->CreationStates as $creationState): // There will be a creation state for each shipment order.
        foreach($creationState->LabelData->Status as $status): // echo all creation state status messages .
            echo '\n-- '.$status->message;
        endforeach;
    endforeach;
endif;
```
### Usage for the tracking api

Set up the request object, call the getPieceDetail function and get its response.
```
$request = new \ChristophSchaeffer\Dhl\BusinessShipping\Request\Tracking\getPieceDetail();
$request->pieceCode = '00340434161094027318';
$response = $client->getPieceDetail($request);
```
To check if the request was successful use the hasNoErrors function. If the request itself or any child object does not
have the status code "0", which is = success, this will return false.
```
if($response->hasNoErrors()): // checks if any error status messages have been returned.
    echo 'Success!';
else:
    echo 'An error occured!\n';
    echo $response->error;   // this is the string error message submitted by dhl
endif;
```

## Documentation
- There is an official documentation by DHL found [here](https://entwickler.dhl.de). However it is partly outdated and incomplete.
- A documentation page for this project can be found [here](https://christoph-schaeffer.de/dhl-business-shipping/documentation/3-0).

## Support
- For reporting bugs and suggestions please use the [issues tab](https://github.com/christoph-schaeffer/dhl-business-shipping/issues).
- If you have any questions feel free to contact me by mail christoph-dietrich@web.de.

## License
This project is licensed under the [MIT license](http://badges.mit-license.org). Please read the [LICENSE file](https://github.com/christoph-schaeffer/dhl-business-shipping/blob/master/LICENSE) for details.
