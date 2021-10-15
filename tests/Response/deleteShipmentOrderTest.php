<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Response;

use ChristophSchaeffer\Dhl\BusinessShipping\Client;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource\Version;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\deleteShipmentOrder as deleteShipmentOrderResponse;
use ChristophSchaeffer\Dhl\BusinessShipping\Request\deleteShipmentOrder as deleteShipmentOrderRequest;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\State\DeletionState;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Status\Success;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\AbstractUnitTest;

/**
 * Class deleteShipmentOrderTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test\Response
 */
class deleteShipmentOrderTest extends AbstractUnitTest {

    /**
     * @return array[]
     */
    public function providerHasNoErrorsWithDeletionState() {
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
     * @return array[]
     */
    public function providerHasNoErrorsWithEmptyDeletionState() {
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
     *
     */
    public function testConstructEmptyDeletionState() {
        $request      = new deleteShipmentOrderRequest([]);
        $soapResponse = $this->mockSoapResponseEmptyDeletionState();

        $response = new deleteShipmentOrderResponse($request, $soapResponse, 'requestTest',
                                                    Client::LANGUAGE_LOCALE_GERMAN_DE);

        $this->assertEquals($soapResponse, $response->rawResponse);
        $this->assertEquals('requestTest', $response->rawRequest);
        $this->assertEquals($request, $response->request);
        $this->assertInstanceOf(deleteShipmentOrderRequest::class, $response->request);

        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(3, $response->Version->majorRelease);
        $this->assertEquals(0, $response->Version->minorRelease);

        $this->assertEquals([(new Success('ok', Client::LANGUAGE_LOCALE_GERMAN_DE))], $response->Status);

        $this->assertTrue(is_array($response->DeletionStates));
        $this->assertCount(1, $response->DeletionStates);
        $deletionState = array_shift($response->DeletionStates);

        $this->assertInstanceOf(DeletionState::class, $deletionState);
        $this->assertNull($deletionState->shipmentNumber);
        $this->assertNull($deletionState->Status);

    }

    /**
     *
     */
    public function testConstructMultipleDeletionStates() {
        $request      = new deleteShipmentOrderRequest([]);
        $soapResponse = $this->mockSoapResponseMultipleDeletionStates();

        $response = new deleteShipmentOrderResponse($request, $soapResponse, 'requestTest',
                                                    Client::LANGUAGE_LOCALE_GERMAN_DE);

        $this->assertEquals($soapResponse, $response->rawResponse);
        $this->assertEquals('requestTest', $response->rawRequest);
        $this->assertEquals($request, $response->request);
        $this->assertInstanceOf(deleteShipmentOrderRequest::class, $response->request);

        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(3, $response->Version->majorRelease);
        $this->assertEquals(0, $response->Version->minorRelease);

        $this->assertEquals([(new Success('ok', Client::LANGUAGE_LOCALE_GERMAN_DE))], $response->Status);

        $this->assertTrue(is_array($response->DeletionStates));
        $this->assertCount(3, $response->DeletionStates);

        $deletionState1 = array_shift($response->DeletionStates);
        $this->assertInstanceOf(DeletionState::class, $deletionState1);
        $this->assertEquals('1234567891', $deletionState1->shipmentNumber);
        $this->assertEquals([(new Success('ok', Client::LANGUAGE_LOCALE_GERMAN_DE))], $deletionState1->Status);

        $deletionState2 = array_shift($response->DeletionStates);
        $this->assertInstanceOf(DeletionState::class, $deletionState2);
        $this->assertEquals('1234567892', $deletionState2->shipmentNumber);
        $this->assertEquals([(new Success('ok', Client::LANGUAGE_LOCALE_GERMAN_DE))], $deletionState2->Status);

        $deletionState3 = array_shift($response->DeletionStates);
        $this->assertInstanceOf(DeletionState::class, $deletionState3);
        $this->assertEquals('1234567893', $deletionState3->shipmentNumber);
        $this->assertEquals([(new Success('ok', Client::LANGUAGE_LOCALE_GERMAN_DE))], $deletionState3->Status);


    }

    /**
     *
     */
    public function testConstructNoDeletionState() {
        $request      = new deleteShipmentOrderRequest([]);
        $soapResponse = $this->mockSoapResponseNoDeletionState();

        $response = new deleteShipmentOrderResponse($request, $soapResponse, 'requestTest',
                                                    Client::LANGUAGE_LOCALE_GERMAN_DE);

        $this->assertEquals($soapResponse, $response->rawResponse);
        $this->assertEquals('requestTest', $response->rawRequest);
        $this->assertEquals($request, $response->request);
        $this->assertInstanceOf(deleteShipmentOrderRequest::class, $response->request);

        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(3, $response->Version->majorRelease);
        $this->assertEquals(0, $response->Version->minorRelease);

        $this->assertEquals([(new Success('ok', Client::LANGUAGE_LOCALE_GERMAN_DE))], $response->Status);

        $this->assertNull($response->DeletionStates);
    }

    /**
     *
     */
    public function testConstructNullDeletionState() {
        $request      = new deleteShipmentOrderRequest([]);
        $soapResponse = $this->mockSoapResponseNullDeletionState();

        $response = new deleteShipmentOrderResponse($request, $soapResponse, 'requestTest',
                                                    Client::LANGUAGE_LOCALE_GERMAN_DE);

        $this->assertEquals($soapResponse, $response->rawResponse);
        $this->assertEquals('requestTest', $response->rawRequest);
        $this->assertEquals($request, $response->request);
        $this->assertInstanceOf(deleteShipmentOrderRequest::class, $response->request);

        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(3, $response->Version->majorRelease);
        $this->assertEquals(0, $response->Version->minorRelease);

        $this->assertEquals([(new Success('ok', Client::LANGUAGE_LOCALE_GERMAN_DE))], $response->Status);

        $this->assertNull($response->DeletionStates);
    }

    /**
     *
     */
    public function testConstructSingleDeletionState() {
        $request      = new deleteShipmentOrderRequest([]);
        $soapResponse = $this->mockSoapResponseSingleDeletionState();

        $response = new deleteShipmentOrderResponse($request, $soapResponse, 'requestTest',
                                                    Client::LANGUAGE_LOCALE_GERMAN_DE);

        $this->assertEquals($soapResponse, $response->rawResponse);
        $this->assertEquals('requestTest', $response->rawRequest);
        $this->assertEquals($request, $response->request);
        $this->assertInstanceOf(deleteShipmentOrderRequest::class, $response->request);

        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(3, $response->Version->majorRelease);
        $this->assertEquals(0, $response->Version->minorRelease);

        $this->assertEquals([(new Success('ok', Client::LANGUAGE_LOCALE_GERMAN_DE))], $response->Status);

        $this->assertTrue(is_array($response->DeletionStates));
        $this->assertCount(1, $response->DeletionStates);
        $deletionState = array_shift($response->DeletionStates);

        $this->assertInstanceOf(DeletionState::class, $deletionState);
        $this->assertEquals('123456789', $deletionState->shipmentNumber);
        $this->assertEquals([(new Success('ok', Client::LANGUAGE_LOCALE_GERMAN_DE))], $deletionState->Status);
    }

    /**
     * @param object  $statusObject
     * @param boolean $expectedResult
     *
     * @dataProvider providerHasNoErrorsWithEmptyDeletionState
     */
    public function testHasNoErrorsWithEmptyDeletionState($statusObject, $expectedResult) {
        $request              = new deleteShipmentOrderRequest([]);
        $soapResponse         = $this->mockSoapResponseEmptyDeletionState();
        $soapResponse->Status = $statusObject;

        $response     = new deleteShipmentOrderResponse($request, $soapResponse, 'requestTest',
                                                        Client::LANGUAGE_LOCALE_GERMAN_DE);
        $actualResult = $response->hasNoErrors();

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @param object  $statusObject
     * @param boolean $expectedResult
     *
     * @dataProvider providerHasNoErrorsWithDeletionState
     */
    public function testHasNoErrorsWithMultipleDeletionStates($statusObject, $expectedResult) {
        $request                                = new deleteShipmentOrderRequest([]);
        $soapResponse                           = $this->mockSoapResponseMultipleDeletionStates();
        $soapResponse->DeletionState[1]->Status = $statusObject;

        $response     = new deleteShipmentOrderResponse($request, $soapResponse, 'requestTest',
                                                        Client::LANGUAGE_LOCALE_GERMAN_DE);
        $actualResult = $response->hasNoErrors();

        $this->assertEquals($expectedResult, $actualResult);

        $soapResponse->DeletionState[0]->Status = $statusObject;

        $response2     = new deleteShipmentOrderResponse($request, $soapResponse, 'requestTest',
                                                         Client::LANGUAGE_LOCALE_GERMAN_DE);
        $actualResult2 = $response2->hasNoErrors();

        $this->assertEquals($expectedResult, $actualResult2);
    }

    /**
     * @param object  $statusObject
     * @param boolean $expectedResult
     *
     * @dataProvider providerHasNoErrorsWithDeletionState
     */
    public function testHasNoErrorsWithSingleDeletionState($statusObject, $expectedResult) {
        $request                             = new deleteShipmentOrderRequest([]);
        $soapResponse                        = $this->mockSoapResponseSingleDeletionState();
        $soapResponse->DeletionState->Status = $statusObject;

        $response     = new deleteShipmentOrderResponse($request, $soapResponse, 'requestTest',
                                                        Client::LANGUAGE_LOCALE_GERMAN_DE);
        $actualResult = $response->hasNoErrors();

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @return object
     */
    private function mockSoapResponseEmptyDeletionState() {
        return (object)[
            'Version'       => (object)[
                'majorRelease' => 3,
                'minorRelease' => 0
            ],
            'Status'        => (object)[
                'statusMessage' => 'ok'
            ],
            'DeletionState' => (object)[]
        ];
    }

    /**
     * @return object
     */
    private function mockSoapResponseMultipleDeletionStates() {
        return (object)[
            'Version'       => (object)[
                'majorRelease' => 3,
                'minorRelease' => 0
            ],
            'Status'        => (object)[
                'statusMessage' => 'ok'
            ],
            'DeletionState' => [
                (object)[
                    'shipmentNumber' => '1234567891',
                    'Status'         => (object)[
                        'statusMessage' => 'ok'
                    ]
                ],
                (object)[
                    'shipmentNumber' => '1234567892',
                    'Status'         => (object)[
                        'statusMessage' => 'ok'
                    ]
                ],
                (object)[
                    'shipmentNumber' => '1234567893',
                    'Status'         => (object)[
                        'statusMessage' => 'ok'
                    ]
                ]
            ]
        ];
    }

    /**
     * @return object
     */
    private function mockSoapResponseNoDeletionState() {
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

    /**
     * @return object
     */
    private function mockSoapResponseNullDeletionState() {
        return (object)[
            'Version'       => (object)[
                'majorRelease' => 3,
                'minorRelease' => 0
            ],
            'Status'        => (object)[
                'statusMessage' => 'ok'
            ],
            'DeletionState' => NULL
        ];
    }

    /**
     * @return object
     */
    private function mockSoapResponseSingleDeletionState() {
        return (object)[
            'Version'       => (object)[
                'majorRelease' => 3,
                'minorRelease' => 0
            ],
            'Status'        => (object)[
                'statusMessage' => 'ok'
            ],
            'DeletionState' => (object)[
                'shipmentNumber' => '123456789',
                'Status'         => (object)[
                    'statusMessage' => 'ok'
                ]
            ]
        ];
    }
}
