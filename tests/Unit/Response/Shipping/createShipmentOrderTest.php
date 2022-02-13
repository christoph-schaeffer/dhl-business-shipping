<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit\Response\Shipping;

use ChristophSchaeffer\Dhl\BusinessShipping\MultiClient;
use ChristophSchaeffer\Dhl\BusinessShipping\Request\Shipping\createShipmentOrder as createShipmentOrderRequest;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource\Version;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\createShipmentOrder as createShipmentOrderResponse;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Data\LabelData;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\State\CreationState;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\Success;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit\AbstractUnitTest;

/**
 * Class createShipmentOrderTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test\Unit\Response\Shipping
 */
class createShipmentOrderTest extends AbstractUnitTest {

    /**
     * @return array[]
     */
    public function providerHasNoErrorsWithCreationState() {
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
    public function providerHasNoErrorsWithEmptyCreationState() {
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
    public function testConstructEmptyCreationState() {
        $request      = new createShipmentOrderRequest([]);
        $soapResponse = $this->mockSoapResponseEmptyCreationState();

        $response = new createShipmentOrderResponse($request, $soapResponse, 'requestTest',
                                                    MultiClient::LANGUAGE_LOCALE_GERMAN_DE);

        $this->assertEquals($soapResponse, $response->rawResponse);
        $this->assertEquals('requestTest', $response->rawRequest);
        $this->assertEquals($request, $response->request);
        $this->assertInstanceOf(createShipmentOrderRequest::class, $response->request);

        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(3, $response->Version->majorRelease);
        $this->assertEquals(0, $response->Version->minorRelease);

        $this->assertEquals([(new Success('ok', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))], $response->Status);

        $this->assertTrue(is_array($response->CreationStates));
        $this->assertCount(1, $response->CreationStates);
        $creationState = array_shift($response->CreationStates);

        $this->assertInstanceOf(CreationState::class, $creationState);
        $this->assertNull($creationState->sequenceNumber);
        $this->assertNull($creationState->shipmentNumber);
        $this->assertNull($creationState->returnShipmentNumber);
        $this->assertNull($creationState->LabelData);
        $this->assertEquals((new CreationState()), $creationState);
    }

    /**
     *
     */
    public function testConstructMultipleCreationStates() {
        $request      = new createShipmentOrderRequest([]);
        $soapResponse = $this->mockSoapResponseMultipleCreationStates();

        $response = new createShipmentOrderResponse($request, $soapResponse, 'requestTest',
                                                    MultiClient::LANGUAGE_LOCALE_GERMAN_DE);

        $this->assertEquals($soapResponse, $response->rawResponse);
        $this->assertEquals('requestTest', $response->rawRequest);
        $this->assertEquals($request, $response->request);
        $this->assertInstanceOf(createShipmentOrderRequest::class, $response->request);

        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(3, $response->Version->majorRelease);
        $this->assertEquals(0, $response->Version->minorRelease);

        $this->assertEquals([(new Success('ok', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))], $response->Status);

        $this->assertTrue(is_array($response->CreationStates));
        $this->assertCount(3, $response->CreationStates);

        $creationState1 = array_shift($response->CreationStates);
        $this->assertInstanceOf(CreationState::class, $creationState1);
        $this->assertEquals(2, $creationState1->sequenceNumber);
        $this->assertEquals('1234567892', $creationState1->shipmentNumber);
        $this->assertEquals('9876543212', $creationState1->returnShipmentNumber);
        $this->assertEquals($this->getMockedLabelData(), $creationState1->LabelData);

        $creationState2 = array_shift($response->CreationStates);
        $this->assertInstanceOf(CreationState::class, $creationState2);
        $this->assertEquals(4, $creationState2->sequenceNumber);
        $this->assertEquals('1234567894', $creationState2->shipmentNumber);
        $this->assertEquals('9876543214', $creationState2->returnShipmentNumber);
        $this->assertEquals($this->getMockedLabelData(), $creationState2->LabelData);

        $creationState3 = array_shift($response->CreationStates);
        $this->assertInstanceOf(CreationState::class, $creationState3);
        $this->assertEquals(1, $creationState3->sequenceNumber);
        $this->assertEquals('1234567891', $creationState3->shipmentNumber);
        $this->assertEquals('9876543211', $creationState3->returnShipmentNumber);
        $this->assertEquals($this->getMockedLabelData(), $creationState3->LabelData);
    }

    /**
     *
     */
    public function testConstructNoCreationState() {
        $request      = new createShipmentOrderRequest([]);
        $soapResponse = $this->mockSoapResponseNoCreationState();

        $response = new createShipmentOrderResponse($request, $soapResponse, 'requestTest',
                                                    MultiClient::LANGUAGE_LOCALE_GERMAN_DE);

        $this->assertEquals($soapResponse, $response->rawResponse);
        $this->assertEquals('requestTest', $response->rawRequest);
        $this->assertEquals($request, $response->request);
        $this->assertInstanceOf(createShipmentOrderRequest::class, $response->request);

        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(3, $response->Version->majorRelease);
        $this->assertEquals(0, $response->Version->minorRelease);

        $this->assertEquals([(new Success('ok', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))], $response->Status);

        $this->assertNull($response->CreationStates);
    }

    /**
     *
     */
    public function testConstructNullCreationState() {
        $request      = new createShipmentOrderRequest([]);
        $soapResponse = $this->mockSoapResponseNullCreationState();

        $response = new createShipmentOrderResponse($request, $soapResponse, 'requestTest',
                                                    MultiClient::LANGUAGE_LOCALE_GERMAN_DE);

        $this->assertEquals($soapResponse, $response->rawResponse);
        $this->assertEquals('requestTest', $response->rawRequest);
        $this->assertEquals($request, $response->request);
        $this->assertInstanceOf(createShipmentOrderRequest::class, $response->request);

        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(3, $response->Version->majorRelease);
        $this->assertEquals(0, $response->Version->minorRelease);

        $this->assertEquals([(new Success('ok', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))], $response->Status);

        $this->assertNull($response->CreationStates);
    }

    /**
     *
     */
    public function testConstructSingleCreationState() {
        $request      = new createShipmentOrderRequest([]);
        $soapResponse = $this->mockSoapResponseSingleCreationState();

        $response = new createShipmentOrderResponse($request, $soapResponse, 'requestTest',
                                                    MultiClient::LANGUAGE_LOCALE_GERMAN_DE);

        $this->assertEquals($soapResponse, $response->rawResponse);
        $this->assertEquals('requestTest', $response->rawRequest);
        $this->assertEquals($request, $response->request);
        $this->assertInstanceOf(createShipmentOrderRequest::class, $response->request);

        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(3, $response->Version->majorRelease);
        $this->assertEquals(0, $response->Version->minorRelease);

        $this->assertEquals([(new Success('ok', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))], $response->Status);

        $this->assertTrue(is_array($response->CreationStates));
        $this->assertCount(1, $response->CreationStates);
        $creationState = array_shift($response->CreationStates);

        $this->assertInstanceOf(CreationState::class, $creationState);
        $this->assertEquals(2, $creationState->sequenceNumber);
        $this->assertEquals('123456789', $creationState->shipmentNumber);
        $this->assertEquals('987654321', $creationState->returnShipmentNumber);
        $this->assertEquals($this->getMockedLabelData(), $creationState->LabelData);

    }

    /**
     * @param object  $statusObject
     * @param boolean $expectedResult
     *
     * @dataProvider providerHasNoErrorsWithEmptyCreationState
     */
    public function testHasNoErrorsWithEmptyCreationState($statusObject, $expectedResult) {
        $request              = new createShipmentOrderRequest([]);
        $soapResponse         = $this->mockSoapResponseEmptyCreationState();
        $soapResponse->Status = $statusObject;

        $response     = new createShipmentOrderResponse($request, $soapResponse, 'requestTest',
                                                        MultiClient::LANGUAGE_LOCALE_GERMAN_DE);
        $actualResult = $response->hasNoErrors();

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @param object  $statusObject
     * @param boolean $expectedResult
     *
     * @dataProvider providerHasNoErrorsWithCreationState
     */
    public function testHasNoErrorsWithMultipleCreationStates($statusObject, $expectedResult) {
        $request                                           = new createShipmentOrderRequest([]);
        $soapResponse                                      = $this->mockSoapResponseMultipleCreationStates();
        $soapResponse->CreationState[1]->LabelData->Status = $statusObject;

        $response     = new createShipmentOrderResponse($request, $soapResponse, 'requestTest',
                                                        MultiClient::LANGUAGE_LOCALE_GERMAN_DE);
        $actualResult = $response->hasNoErrors();

        $this->assertEquals($expectedResult, $actualResult);

        $soapResponse->CreationState[0]->LabelData->Status = $statusObject;

        $response2     = new createShipmentOrderResponse($request, $soapResponse, 'requestTest',
                                                         MultiClient::LANGUAGE_LOCALE_GERMAN_DE);
        $actualResult2 = $response2->hasNoErrors();

        $this->assertEquals($expectedResult, $actualResult2);
    }

    /**
     * @param object  $statusObject
     * @param boolean $expectedResult
     *
     * @dataProvider providerHasNoErrorsWithCreationState
     */
    public function testHasNoErrorsWithSingleCreationState($statusObject, $expectedResult) {
        $request                                        = new createShipmentOrderRequest([]);
        $soapResponse                                   = $this->mockSoapResponseSingleCreationState();
        $soapResponse->CreationState->LabelData->Status = $statusObject;

        $response     = new createShipmentOrderResponse($request, $soapResponse, 'requestTest',
                                                        MultiClient::LANGUAGE_LOCALE_GERMAN_DE);
        $actualResult = $response->hasNoErrors();

        $this->assertEquals($expectedResult, $actualResult);
    }

    private function getMockedLabelData() {
        return new LabelData(
            MultiClient::LANGUAGE_LOCALE_GERMAN_DE,
            (object)['Status' => (object)['statusText' => 'ok']]
        );
    }

    /**
     * @return object
     */
    private function mockSoapResponseEmptyCreationState() {
        return (object)[
            'Version'       => (object)[
                'majorRelease' => 3,
                'minorRelease' => 0
            ],
            'Status'        => (object)[
                'statusText' => 'ok'
            ],
            'CreationState' => (object)[]
        ];
    }

    /**
     * @return object
     */
    private function mockSoapResponseMultipleCreationStates() {
        return (object)[
            'Version'       => (object)[
                'majorRelease' => 3,
                'minorRelease' => 0
            ],
            'Status'        => (object)[
                'statusText' => 'ok'
            ],
            'CreationState' => [
                (object)[
                    'sequenceNumber'       => 2,
                    'shipmentNumber'       => '1234567892',
                    'returnShipmentNumber' => '9876543212',
                    'LabelData'            => (object)[
                        'Status' => (object)[
                            'statusText' => 'ok'
                        ]
                    ]
                ],
                (object)[
                    'sequenceNumber'       => 4,
                    'shipmentNumber'       => '1234567894',
                    'returnShipmentNumber' => '9876543214',
                    'LabelData'            => (object)[
                        'Status' => (object)[
                            'statusText' => 'ok'
                        ]
                    ]
                ],
                (object)[
                    'sequenceNumber'       => 1,
                    'shipmentNumber'       => '1234567891',
                    'returnShipmentNumber' => '9876543211',
                    'LabelData'            => (object)[
                        'Status' => (object)[
                            'statusText' => 'ok'
                        ]
                    ]
                ]
            ]
        ];
    }

    /**
     * @return object
     */
    private function mockSoapResponseNoCreationState() {
        return (object)[
            'Version' => (object)[
                'majorRelease' => 3,
                'minorRelease' => 0
            ],
            'Status'  => (object)[
                'statusText' => 'ok'
            ]
        ];
    }

    /**
     * @return object
     */
    private function mockSoapResponseNullCreationState() {
        return (object)[
            'Version'       => (object)[
                'majorRelease' => 3,
                'minorRelease' => 0
            ],
            'Status'        => (object)[
                'statusText' => 'ok'
            ],
            'CreationState' => NULL
        ];
    }

    /**
     * @return object
     */
    private function mockSoapResponseSingleCreationState() {
        return (object)[
            'Version'       => (object)[
                'majorRelease' => 3,
                'minorRelease' => 0
            ],
            'Status'        => (object)[
                'statusText' => 'ok'
            ],
            'CreationState' => (object)[
                'sequenceNumber'       => 2,
                'shipmentNumber'       => '123456789',
                'returnShipmentNumber' => '987654321',
                'LabelData'            => (object)[
                    'Status' => (object)[
                        'statusText' => 'ok'
                    ]
                ]
            ]
        ];
    }
}
