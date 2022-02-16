<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Integration;

use ChristophSchaeffer\Dhl\BusinessShipping\Credentials\ShippingClientCredentials;
use ChristophSchaeffer\Dhl\BusinessShipping\MultiClient;
use ChristophSchaeffer\Dhl\BusinessShipping\Protocol\Soap;
use ChristophSchaeffer\Dhl\BusinessShipping\Request;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource;
use ChristophSchaeffer\Dhl\BusinessShipping\Response;
use ChristophSchaeffer\Dhl\BusinessShipping\ShippingClient;

/**
 * Class ShippingClientIntegrationTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test\Integration
 */
class ShippingClientIntegrationTest extends AbstractIntegrationTest {


    /**
     * @throws \SoapFault
     */
    public function testCreateShipmentOrder() {
        $client   = $this->getClient();
        $request  = new Request\Shipping\createShipmentOrder([]);
        $response = $client->createShipmentOrder($request);

        $this->defaultAssertions($response);
        $this->assertInstanceOf(Response\Shipping\createShipmentOrder::class, $response);
        $this->assertInstanceOf(Request\Shipping\createShipmentOrder::class, $response->request);
    }

    /**
     * @throws \SoapFault
     */
    public function testDeleteShipmentOrder() {
        $client   = $this->getClient();
        $request  = new Request\Shipping\deleteShipmentOrder([]);
        $response = $client->deleteShipmentOrder($request);

        $this->defaultAssertions($response);
        $this->assertInstanceOf(Response\Shipping\deleteShipmentOrder::class, $response);
        $this->assertInstanceOf(Request\Shipping\deleteShipmentOrder::class, $response->request);
    }

    /**
     * @throws \SoapFault
     */
    public function testDoManifest() {
        $client   = $this->getClient();
        $request  = new Request\Shipping\doManifest([]);
        $response = $client->doManifest($request);

        $this->defaultAssertions($response);
        $this->assertInstanceOf(Response\Shipping\doManifest::class, $response);
        $this->assertInstanceOf(Request\Shipping\doManifest::class, $response->request);
    }

    /**
     * @throws \SoapFault
     */
    public function testGetExportDoc() {
        $client   = $this->getClient();
        $request  = new Request\Shipping\getExportDoc([]);
        $response = $client->getExportDoc($request);

        $this->defaultAssertions($response);
        $this->assertInstanceOf(Response\Shipping\getExportDoc::class, $response);
        $this->assertInstanceOf(Request\Shipping\getExportDoc::class, $response->request);
    }

    /**
     * @throws \SoapFault
     */
    public function testGetLabel() {
        $client   = $this->getClient();
        $request  = new Request\Shipping\getLabel([]);
        $response = $client->getLabel($request);

        $this->defaultAssertions($response);
        $this->assertInstanceOf(Response\Shipping\getLabel::class, $response);
        $this->assertInstanceOf(Request\Shipping\getLabel::class, $response->request);
    }

    /**
     * @throws \SoapFault
     */
    public function testGetManifest() {
        $client   = $this->getClient();
        $request  = new Request\Shipping\getManifest('2020-01-01');
        $response = $client->getManifest($request);

        $this->defaultAssertions($response);
        $this->assertInstanceOf(Response\Shipping\getManifest::class, $response);
        $this->assertInstanceOf(Request\Shipping\getManifest::class, $response->request);
    }

    /**
     * @throws \SoapFault
     */
    public function testGetVersion() {
        $client   = $this->getClient();
        $request  = new Request\Shipping\getVersion();
        $response = $client->getVersion($request);

        $this->defaultAssertions($response);
        $this->assertInstanceOf(Response\Shipping\getVersion::class, $response);
        $this->assertInstanceOf(Request\Shipping\getVersion::class, $response->request);
    }

    /**
     * @throws \SoapFault
     */
    public function testUpdateShipmentOrder() {
        $client        = $this->getClient();
        $shipmentOrder = new Resource\ShipmentOrder();
        $request       = new Request\Shipping\updateShipmentOrder('123456789', $shipmentOrder);
        $response      = $client->updateShipmentOrder($request);

        $this->defaultAssertions($response);
        $this->assertInstanceOf(Response\Shipping\updateShipmentOrder::class, $response);
        $this->assertInstanceOf(Request\Shipping\updateShipmentOrder::class, $response->request);
    }

    /**
     * @throws \SoapFault
     */
    public function testValidateShipment() {
        $client   = $this->getClient();
        $request  = new Request\Shipping\validateShipment([]);
        $response = $client->validateShipment($request);

        $this->defaultAssertions($response);
        $this->assertInstanceOf(Response\Shipping\validateShipment::class, $response);
        $this->assertInstanceOf(Request\Shipping\validateShipment::class, $response->request);
    }

    /**
     * @param Response\AbstractShippingResponse $response
     */
    private function defaultAssertions(Response\AbstractShippingResponse $response) {
        $this->assertEquals('xmlString', $response->rawRequest);
        $this->assertEquals($this->mockResponse(), $response->rawResponse);

        $this->assertEquals((new Response\Shipping\Status\Success('ok', MultiClient::LANGUAGE_LOCALE_GERMAN_DE)), array_shift($response->Status));

        $this->assertInstanceOf(Resource\Version::class, $response->Version);
        $this->assertEquals(3, $response->Version->majorRelease);
        $this->assertEquals(0, $response->Version->minorRelease);
    }

    /**
     * @return ShippingClient
     * @throws \SoapFault
     */
    private function getClient() {
        $soapMock = $this->getMockBuilder(Soap::class)
                         ->setConstructorArgs(['appIDTest', 'apiTokenTest', 'loginTest', 'passwordTest', TRUE])
                         ->setMethods(['callSoapFunction', 'getLastSoapXMLRequest'])
                         ->getMock()
        ;

        $soapMock->method('callSoapFunction')
                 ->willReturn($this->mockResponse())
        ;

        $soapMock->method('getLastSoapXMLRequest')
                 ->willReturn('xmlString')
        ;

        $credentials = new ShippingClientCredentials('appIDTest', 'apiTokenTest', 'loginTest', 'passwordTest');

        return new ShippingClient($credentials, TRUE,MultiClient::LANGUAGE_LOCALE_GERMAN_DE, $soapMock);
    }

    /**
     * @return object
     */
    private function mockResponse() {
        return (object)[
            'Version' => (object)[
                'majorRelease' => 3,
                'minorRelease' => 0
            ],
            'Status'  => (object)[
                'statusMessage' => 'ok'
            ]
        ];
    }
}

?>
