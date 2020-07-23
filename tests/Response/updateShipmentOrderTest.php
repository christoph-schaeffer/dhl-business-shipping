<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Response;

use ChristophSchaeffer\Dhl\BusinessShipping\Client;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource\Version;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\updateShipmentOrder as updateShipmentOrderResponse;
use ChristophSchaeffer\Dhl\BusinessShipping\Request\updateShipmentOrder as updateShipmentOrderRequest;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Data\LabelData;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Status\Success;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\AbstractUnitTest;

/**
 * Class updateShipmentOrderTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test\Response
 */
class updateShipmentOrderTest extends AbstractUnitTest {

    /**
     * @return array[]
     */
    public function providerHasNoErrorsWithEmptyLabelData() {
        return [
            [(object)['statusMessage' => 'ok'], FALSE],
            [(object)['statusMessage' => 'Der Webservice wurde ohne Fehler ausgeführt.'], FALSE],
            [(object)['statusMessage' => 'Der Webservice wurde ohne Fehler ausgeführt.', 'statusText' => 'ok'], FALSE],
            [(object)['statusMessage' => ' '], FALSE],
            [(object)['statusMessage' => 'Bitte geben Sie ein Produkt an.'], FALSE],
            [(object)['statusText' => 'Connection failure'], FALSE],
            [(object)['statusCode' => 2010, 'statusText' => 'Illegal Shipment State'], FALSE],
            [(object)['statusMessage' => ['ok', 'Bitte geben Sie ein Produkt an.']], FALSE],
            [(object)['statusText' => 'ok', 'statusMessage' => 'Connection failure'], FALSE],
            [(object)['statusMessage' => 'ok', 'statusCode' => 2010], FALSE],
            [(object)['statusMessage' => [' ', 'ok']], FALSE],
            [(object)['statusMessage' => ['Bitte geben Sie ein Produkt an.', 'ok']], FALSE],
            [(object)['statusCode' => 2010, 'statusMessage' => ['ok', 'Bitte geben Sie ein Produkt an.'], 'statusText' => 'ok'], FALSE]
        ];
    }

    /**
     * @return array[]
     */
    public function providerHasNoErrorsWithLabelData() {
        return [
            [(object)['statusMessage' => 'ok'], TRUE],
            [(object)['statusMessage' => 'Der Webservice wurde ohne Fehler ausgeführt.'], TRUE],
            [(object)['statusMessage' => 'Der Webservice wurde ohne Fehler ausgeführt.', 'statusText' => 'ok'], TRUE],
            [(object)['statusMessage' => ' '], FALSE],
            [(object)['statusMessage' => 'Bitte geben Sie ein Produkt an.'], FALSE],
            [(object)['statusText' => 'Connection failure'], FALSE],
            [(object)['statusCode' => 2010, 'statusText' => 'Illegal Shipment State'], FALSE],
            [(object)['statusMessage' => ['ok', 'Bitte geben Sie ein Produkt an.']], FALSE],
            [(object)['statusText' => 'ok', 'statusMessage' => 'Connection failure'], FALSE],
            [(object)['statusMessage' => 'ok', 'statusCode' => 2010], FALSE],
            [(object)['statusMessage' => [' ', 'ok']], FALSE],
            [(object)['statusMessage' => ['Bitte geben Sie ein Produkt an.', 'ok']], FALSE],
            [(object)['statusCode' => 2010, 'statusMessage' => ['ok', 'Bitte geben Sie ein Produkt an.'], 'statusText' => 'ok'], FALSE]
        ];
    }

    /**
     *
     */
    public function testConstructWithEmptyLabelData() {
        $request      = new updateShipmentOrderRequest('123456789', (new ShipmentOrder()));
        $soapResponse = $this->mockSoapResponseWithEmptyLabelData();

        $response = new updateShipmentOrderResponse($request, $soapResponse, 'requestTest',
                                                    Client::LANGUAGE_LOCALE_GERMAN_DE);

        $this->assertEquals($soapResponse, $response->rawResponse);
        $this->assertEquals('requestTest', $response->rawRequest);
        $this->assertEquals($request, $response->request);
        $this->assertInstanceOf(updateShipmentOrderRequest::class, $response->request);

        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(3, $response->Version->majorRelease);
        $this->assertEquals(0, $response->Version->minorRelease);

        $this->assertEquals([(new Success('ok', Client::LANGUAGE_LOCALE_GERMAN_DE))], $response->Status);

        $this->assertEquals((new LabelData(Client::LANGUAGE_LOCALE_GERMAN_DE)), $response->LabelData);
    }

    /**
     *
     */
    public function testConstructWithLabelData() {
        $request      = new updateShipmentOrderRequest('123456789', (new ShipmentOrder()));
        $soapResponse = $this->mockSoapResponseWithLabelData();

        $response = new updateShipmentOrderResponse($request, $soapResponse, 'requestTest',
                                                    Client::LANGUAGE_LOCALE_GERMAN_DE);

        $this->assertEquals($soapResponse, $response->rawResponse);
        $this->assertEquals('requestTest', $response->rawRequest);
        $this->assertEquals($request, $response->request);
        $this->assertInstanceOf(updateShipmentOrderRequest::class, $response->request);

        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(3, $response->Version->majorRelease);
        $this->assertEquals(0, $response->Version->minorRelease);

        $this->assertEquals([(new Success('ok', Client::LANGUAGE_LOCALE_GERMAN_DE))], $response->Status);

        $this->assertEquals((new LabelData(Client::LANGUAGE_LOCALE_GERMAN_DE)), $response->LabelData);
    }

    /**
     *
     */
    public function testConstructWithoutLabelData() {
        $request      = new updateShipmentOrderRequest('123456789', (new ShipmentOrder()));
        $soapResponse = $this->mockSoapResponseWithoutLabelData();

        $response = new updateShipmentOrderResponse($request, $soapResponse, 'requestTest',
                                                    Client::LANGUAGE_LOCALE_GERMAN_DE);

        $this->assertEquals($soapResponse, $response->rawResponse);
        $this->assertEquals('requestTest', $response->rawRequest);
        $this->assertEquals($request, $response->request);
        $this->assertInstanceOf(updateShipmentOrderRequest::class, $response->request);

        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(3, $response->Version->majorRelease);
        $this->assertEquals(0, $response->Version->minorRelease);

        $this->assertEquals([(new Success('ok', Client::LANGUAGE_LOCALE_GERMAN_DE))], $response->Status);

        $this->assertNull($response->LabelData);
    }

    /**
     * @param object  $statusObject
     * @param boolean $expectedResult
     *
     * @dataProvider providerHasNoErrorsWithEmptyLabelData
     */
    public function testHasNoErrorsWithEmptyLabelData($statusObject, $expectedResult) {
        $request              = new updateShipmentOrderRequest('123456789', (new ShipmentOrder()));
        $soapResponse         = $this->mockSoapResponseWithEmptyLabelData();
        $soapResponse->Status = $statusObject;

        $response     = new updateShipmentOrderResponse($request, $soapResponse, 'requestTest',
                                                        Client::LANGUAGE_LOCALE_GERMAN_DE);
        $actualResult = $response->hasNoErrors();

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @param object  $statusObject
     * @param boolean $expectedResult
     *
     * @dataProvider providerHasNoErrorsWithLabelData
     */
    public function testHasNoErrorsWithSingleLabelData($statusObject, $expectedResult) {
        $request                         = new updateShipmentOrderRequest('123456789', (new ShipmentOrder()));
        $soapResponse                    = $this->mockSoapResponseWithLabelData();
        $soapResponse->LabelData->Status = $statusObject;

        $response     = new updateShipmentOrderResponse($request, $soapResponse, 'requestTest',
                                                        Client::LANGUAGE_LOCALE_GERMAN_DE);
        $actualResult = $response->hasNoErrors();

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @return object
     */
    private function mockSoapResponseWithEmptyLabelData() {
        return (object)[
            'Version'   => (object)[
                'majorRelease' => 3,
                'minorRelease' => 0
            ],
            'Status'    => (object)[
                'statusMessage' => 'ok'
            ],
            'LabelData' => NULL //has its own test
        ];
    }

    /**
     * @return object
     */
    private function mockSoapResponseWithLabelData() {
        return (object)[
            'Version'   => (object)[
                'majorRelease' => 3,
                'minorRelease' => 0
            ],
            'Status'    => (object)[
                'statusMessage' => 'ok'
            ],
            'LabelData' => (object)[] //has its own test
        ];
    }

    /**
     * @return object
     */
    private function mockSoapResponseWithoutLabelData() {
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
