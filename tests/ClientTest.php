<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test;

use ChristophSchaeffer\Dhl\BusinessShipping\Client;
use ChristophSchaeffer\Dhl\BusinessShipping\Request;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource;
use ChristophSchaeffer\Dhl\BusinessShipping\Response;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;
use ChristophSchaeffer\Dhl\BusinessShipping\Soap;

/**
 * Class ClientTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test
 */
class ClientTest extends AbstractUnitTest {

    /**
     * @throws \ReflectionException
     * @throws \SoapFault
     */
    public function testConstruct() {

        $clientEn = new Client('appIDTest', 'apiTokenTest', 'loginTest', 'passwordTest',
                               TRUE, Client::LANGUAGE_LOCALE_ENGLISH_GB);

        $this->assertEquals(Client::LANGUAGE_LOCALE_ENGLISH_GB, $this->getProtectedPropertyValue($clientEn, 'languageLocale'));

        $client = new Client('appIDTest', 'apiTokenTest', 'loginTest', 'passwordTest',
                             TRUE);
        $this->assertEquals(Client::LANGUAGE_LOCALE_GERMAN_DE, $this->getProtectedPropertyValue($client, 'languageLocale'));

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
     * @throws \SoapFault
     */
    public function testCreateShipmentOrder() {
        $client   = $this->getClient();
        $request  = new Request\createShipmentOrder([]);
        $response = $client->createShipmentOrder($request);

        $this->defaultAssertions($response);
        $this->assertInstanceOf(Response\createShipmentOrder::class, $response);
        $this->assertInstanceOf(Request\createShipmentOrder::class, $response->request);
    }

    /**
     * @throws \SoapFault
     */
    public function testDeleteShipmentOrder() {
        $client   = $this->getClient();
        $request  = new Request\deleteShipmentOrder([]);
        $response = $client->deleteShipmentOrder($request);

        $this->defaultAssertions($response);
        $this->assertInstanceOf(Response\deleteShipmentOrder::class, $response);
        $this->assertInstanceOf(Request\deleteShipmentOrder::class, $response->request);
    }

    /**
     * @throws \SoapFault
     */
    public function testDoManifest() {
        $client   = $this->getClient();
        $request  = new Request\doManifest([]);
        $response = $client->doManifest($request);

        $this->defaultAssertions($response);
        $this->assertInstanceOf(Response\doManifest::class, $response);
        $this->assertInstanceOf(Request\doManifest::class, $response->request);
    }

    /**
     * @throws \SoapFault
     */
    public function testGetExportDoc() {
        $client   = $this->getClient();
        $request  = new Request\getExportDoc([]);
        $response = $client->getExportDoc($request);

        $this->defaultAssertions($response);
        $this->assertInstanceOf(Response\getExportDoc::class, $response);
        $this->assertInstanceOf(Request\getExportDoc::class, $response->request);
    }

    /**
     * @throws \SoapFault
     */
    public function testGetLabel() {
        $client   = $this->getClient();
        $request  = new Request\getLabel([]);
        $response = $client->getLabel($request);

        $this->defaultAssertions($response);
        $this->assertInstanceOf(Response\getLabel::class, $response);
        $this->assertInstanceOf(Request\getLabel::class, $response->request);
    }

    /**
     * @throws \SoapFault
     */
    public function testGetManifest() {
        $client   = $this->getClient();
        $request  = new Request\getManifest('2020-01-01');
        $response = $client->getManifest($request);

        $this->defaultAssertions($response);
        $this->assertInstanceOf(Response\getManifest::class, $response);
        $this->assertInstanceOf(Request\getManifest::class, $response->request);
    }

    /**
     * @throws \SoapFault
     */
    public function testGetVersion() {
        $client   = $this->getClient();
        $request  = new Request\getVersion();
        $response = $client->getVersion($request);

        $this->defaultAssertions($response);
        $this->assertInstanceOf(Response\getVersion::class, $response);
        $this->assertInstanceOf(Request\getVersion::class, $response->request);
    }

    /**
     * @throws \SoapFault
     */
    public function testUpdateShipmentOrder() {
        $client        = $this->getClient();
        $shipmentOrder = new Resource\ShipmentOrder();
        $request       = new Request\updateShipmentOrder('123456789', $shipmentOrder);
        $response      = $client->updateShipmentOrder($request);

        $this->defaultAssertions($response);
        $this->assertInstanceOf(Response\updateShipmentOrder::class, $response);
        $this->assertInstanceOf(Request\updateShipmentOrder::class, $response->request);
    }

    /**
     * @throws \SoapFault
     */
    public function testValidateShipment() {
        $client   = $this->getClient();
        $request  = new Request\validateShipment([]);
        $response = $client->validateShipment($request);

        $this->defaultAssertions($response);
        $this->assertInstanceOf(Response\validateShipment::class, $response);
        $this->assertInstanceOf(Request\validateShipment::class, $response->request);
    }

    /**
     * @param Response\AbstractResponse $response
     */
    private function defaultAssertions(Response\AbstractResponse $response) {
        $this->assertEquals('xmlString', $response->rawRequest);
        $this->assertEquals($this->mockResponse(), $response->rawResponse);

        $this->assertEquals((new Status\Success('ok', Client::LANGUAGE_LOCALE_GERMAN_DE)), array_shift($response->Status));

        $this->assertInstanceOf(Resource\Version::class, $response->Version);
        $this->assertEquals(3, $response->Version->majorRelease);
        $this->assertEquals(0, $response->Version->minorRelease);
    }

    /**
     * @return Client
     * @throws \SoapFault
     */
    private function getClient() {
        $soapMock = $this->getMockBuilder(Soap::class)
                         ->setConstructorArgs(['appIDTest', 'apiTokenTest', 'loginTest', 'passwordTest', TRUE])
                         ->onlyMethods(['callSoapFunction', 'getLastSoapXMLRequest'])
                         ->getMock()
        ;

        $soapMock->method('callSoapFunction')
                 ->willReturn($this->mockResponse())
        ;

        $soapMock->method('getLastSoapXMLRequest')
                 ->willReturn('xmlString')
        ;

        return new Client('appIDTest', 'apiTokenTest', 'loginTest', 'passwordTest', TRUE,
                          Client::LANGUAGE_LOCALE_GERMAN_DE, $soapMock);
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