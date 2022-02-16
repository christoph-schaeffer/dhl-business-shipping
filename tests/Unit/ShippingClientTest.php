<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit;

use ChristophSchaeffer\Dhl\BusinessShipping\Credentials\ShippingClientCredentials;
use ChristophSchaeffer\Dhl\BusinessShipping\MultiClient;
use ChristophSchaeffer\Dhl\BusinessShipping\Protocol\Soap;
use ChristophSchaeffer\Dhl\BusinessShipping\Request;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource;
use ChristophSchaeffer\Dhl\BusinessShipping\ShippingClient;

/**
 * Class ShippingClientTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test\Unit
 */
class ShippingClientTest extends AbstractUnitTest {

    /**
     * @throws \ReflectionException
     * @throws \SoapFault
     */
    public function testConstruct() {

        $credentials = new ShippingClientCredentials('appIDTest', 'apiTokenTest', 'loginTest', 'passwordTest');
        $clientEn = new ShippingClient($credentials, TRUE, MultiClient::LANGUAGE_LOCALE_ENGLISH_GB);

        $this->assertEquals(MultiClient::LANGUAGE_LOCALE_ENGLISH_GB, $this->getProtectedPropertyValue($clientEn, 'languageLocale'));

        $client = new ShippingClient($credentials, TRUE);
        $this->assertEquals(MultiClient::LANGUAGE_LOCALE_GERMAN_DE, $this->getProtectedPropertyValue($client, 'languageLocale'));

        $soap = $this->getProtectedPropertyValue($client, 'soap');

        $this->assertInstanceOf(Soap::class, $soap);
        $this->assertEquals('https://cig.dhl.de/services/sandbox/soap', $soap->location);
        $this->assertEquals('appIDTest', $soap->_login);
        $this->assertEquals('apiTokenTest', $soap->_password);

        $soapHeader = $soap->__default_headers[0];
        $this->assertEquals('loginTest', $soapHeader->data['user']);
        $this->assertEquals('passwordTest', $soapHeader->data['signature']);
    }

    /**
     * @throws \ReflectionException
     */
    public function testSanitizeRequest() {
        $shipmentOrder = new Resource\ShipmentOrder();
        $shipmentOrder->Shipment->ShipmentDetails->product = 'V01PAK';
        $shipmentOrder->Shipment->ShipmentDetails->accountNumber = '22222222220101';
        $shipmentOrder->Shipment->ShipmentDetails->ShipmentItem->weightInKG = 1.2;
        $shipmentOrder->Shipment->ShipmentDetails->shipmentDate = '2020-12-08';

        $shipmentOrder->Shipment->Shipper->Name->name1 = 'DHL Paket GmbH';
        $shipmentOrder->Shipment->Shipper->Address->streetName = 'Sträßchensweg';
        $shipmentOrder->Shipment->Shipper->Address->streetNumber = '10';
        $shipmentOrder->Shipment->Shipper->Address->zip = '53113';
        $shipmentOrder->Shipment->Shipper->Address->city = 'Bonn';
        $shipmentOrder->Shipment->Shipper->Address->Origin->countryISOCode = 'DE';

        $shipmentOrder->Shipment->Receiver->name1 = 'DHL Paket GmbH';
        $shipmentOrder->Shipment->Receiver->Address->streetName = 'Charles-de-Gaulle-Str.';
        $shipmentOrder->Shipment->Receiver->Address->streetNumber = '20';
        $shipmentOrder->Shipment->Receiver->Address->zip = '53113';
        $shipmentOrder->Shipment->Receiver->Address->city = 'Bonn';
        $shipmentOrder->Shipment->Receiver->Address->Origin->countryISOCode = 'DE';

        $request = new Request\Shipping\createShipmentOrder([$shipmentOrder]);

        $sanitizedRequest = $this->runProtectedMethod((new ShippingClient(new ShippingClientCredentials('', ''))), 'sanitizeRequest', [
            $request
        ]);

        $this->assertInstanceOf(Request\Shipping\createShipmentOrder::class, $sanitizedRequest);
        $this->assertFalse(array_key_exists('labelFormat', (array)$sanitizedRequest));
        $this->assertTrue(0 === $sanitizedRequest->combinedPrinting, 'Boolean conversion, doesnt work properly. Expected request createShipmentOrder combinedPrinting to be 0 (int)');

        $sanitizedShipmentOrder = array_shift($sanitizedRequest->ShipmentOrder);
        $this->assertInstanceOf(Resource\ShipmentOrder::class, $sanitizedShipmentOrder);
        $this->assertTrue(1 === $sanitizedShipmentOrder->sequenceNumber, 'Boolean conversion, doesnt work properly. Expected shipmentOrder sequenceNumber to be 1 (int)');
        $this->assertTrue('1.2' === $sanitizedShipmentOrder->Shipment->ShipmentDetails->ShipmentItem->weightInKG, 'Float conversion, doesnt work properly. Expected shipmentItem weightInKg to be "1.2" (string)');
    }
}

?>
