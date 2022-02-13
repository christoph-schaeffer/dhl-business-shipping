<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit\Response\Shipping;

use ChristophSchaeffer\Dhl\BusinessShipping\MultiClient;
use ChristophSchaeffer\Dhl\BusinessShipping\Request\Shipping\validateShipment as validateShipmentRequest;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource\Version;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\State\ValidationState;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\Success;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\validateShipment as validateShipmentResponse;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\AbstractUnitTest;

/**
 * Class validateShipmentTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test\Response
 */
class validateShipmentTest extends AbstractUnitTest {

    /**
     * @return array[]
     */
    public function providerHasNoErrorsWithEmptyValidationState() {
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
    public function providerHasNoErrorsWithValidationState() {
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
    public function testConstructEmptyValidationState() {
        $request      = new validateShipmentRequest([]);
        $soapResponse = $this->mockSoapResponseEmptyValidationState();

        $response = new validateShipmentResponse($request, $soapResponse, 'requestTest',
                                                 MultiClient::LANGUAGE_LOCALE_GERMAN_DE);

        $this->assertEquals($soapResponse, $response->rawResponse);
        $this->assertEquals('requestTest', $response->rawRequest);
        $this->assertEquals($request, $response->request);
        $this->assertInstanceOf(validateShipmentRequest::class, $response->request);

        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(3, $response->Version->majorRelease);
        $this->assertEquals(0, $response->Version->minorRelease);

        $this->assertEquals([(new Success('ok', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))], $response->Status);

        $this->assertTrue(is_array($response->ValidationStates));
        $this->assertCount(1, $response->ValidationStates);
        $validationState = array_shift($response->ValidationStates);

        $this->assertInstanceOf(ValidationState::class, $validationState);
        $this->assertNull($validationState->sequenceNumber);
        $this->assertEquals((new ValidationState()), $validationState);
    }

    /**
     *
     */
    public function testConstructMultipleValidationStates() {
        $request      = new validateShipmentRequest([]);
        $soapResponse = $this->mockSoapResponseMultipleValidationStates();

        $response = new validateShipmentResponse($request, $soapResponse, 'requestTest',
                                                 MultiClient::LANGUAGE_LOCALE_GERMAN_DE);

        $this->assertEquals($soapResponse, $response->rawResponse);
        $this->assertEquals('requestTest', $response->rawRequest);
        $this->assertEquals($request, $response->request);
        $this->assertInstanceOf(validateShipmentRequest::class, $response->request);

        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(3, $response->Version->majorRelease);
        $this->assertEquals(0, $response->Version->minorRelease);

        $this->assertEquals([(new Success('ok', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))], $response->Status);

        $this->assertTrue(is_array($response->ValidationStates));
        $this->assertCount(3, $response->ValidationStates);

        $validationState1 = array_shift($response->ValidationStates);
        $this->assertInstanceOf(ValidationState::class, $validationState1);
        $this->assertEquals(2, $validationState1->sequenceNumber);

        $validationState2 = array_shift($response->ValidationStates);
        $this->assertInstanceOf(ValidationState::class, $validationState2);
        $this->assertEquals(4, $validationState2->sequenceNumber);
        $this->assertEquals([(new Success('ok', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))], $validationState2->Status);

        $validationState3 = array_shift($response->ValidationStates);
        $this->assertInstanceOf(ValidationState::class, $validationState3);
        $this->assertEquals(1, $validationState3->sequenceNumber);
    }

    /**
     *
     */
    public function testConstructNoValidationState() {
        $request      = new validateShipmentRequest([]);
        $soapResponse = $this->mockSoapResponseNoValidationState();

        $response = new validateShipmentResponse($request, $soapResponse, 'requestTest',
                                                 MultiClient::LANGUAGE_LOCALE_GERMAN_DE);

        $this->assertEquals($soapResponse, $response->rawResponse);
        $this->assertEquals('requestTest', $response->rawRequest);
        $this->assertEquals($request, $response->request);
        $this->assertInstanceOf(validateShipmentRequest::class, $response->request);

        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(3, $response->Version->majorRelease);
        $this->assertEquals(0, $response->Version->minorRelease);

        $this->assertEquals([(new Success('ok', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))], $response->Status);

        $this->assertNull($response->ValidationStates);
    }

    /**
     *
     */
    public function testConstructNullValidationState() {
        $request      = new validateShipmentRequest([]);
        $soapResponse = $this->mockSoapResponseNullValidationState();

        $response = new validateShipmentResponse($request, $soapResponse, 'requestTest',
                                                 MultiClient::LANGUAGE_LOCALE_GERMAN_DE);

        $this->assertEquals($soapResponse, $response->rawResponse);
        $this->assertEquals('requestTest', $response->rawRequest);
        $this->assertEquals($request, $response->request);
        $this->assertInstanceOf(validateShipmentRequest::class, $response->request);

        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(3, $response->Version->majorRelease);
        $this->assertEquals(0, $response->Version->minorRelease);

        $this->assertEquals([(new Success('ok', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))], $response->Status);

        $this->assertNull($response->ValidationStates);
    }

    /**
     *
     */
    public function testConstructSingleValidationState() {
        $request      = new validateShipmentRequest([]);
        $soapResponse = $this->mockSoapResponseSingleValidationState();

        $response = new validateShipmentResponse($request, $soapResponse, 'requestTest',
                                                 MultiClient::LANGUAGE_LOCALE_GERMAN_DE);

        $this->assertEquals($soapResponse, $response->rawResponse);
        $this->assertEquals('requestTest', $response->rawRequest);
        $this->assertEquals($request, $response->request);
        $this->assertInstanceOf(validateShipmentRequest::class, $response->request);

        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(3, $response->Version->majorRelease);
        $this->assertEquals(0, $response->Version->minorRelease);

        $this->assertEquals([(new Success('ok', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))], $response->Status);

        $this->assertTrue(is_array($response->ValidationStates));
        $this->assertCount(1, $response->ValidationStates);
        $validationState = array_shift($response->ValidationStates);

        $this->assertInstanceOf(ValidationState::class, $validationState);
        $this->assertEquals(2, $validationState->sequenceNumber);
        $this->assertEquals([(new Success('ok', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))], $validationState->Status);
    }

    /**
     * @param object  $statusObject
     * @param boolean $expectedResult
     *
     * @dataProvider providerHasNoErrorsWithEmptyValidationState
     */
    public function testHasNoErrorsWithEmptyValidationState($statusObject, $expectedResult) {
        $request              = new validateShipmentRequest([]);
        $soapResponse         = $this->mockSoapResponseEmptyValidationState();
        $soapResponse->Status = $statusObject;

        $response     = new validateShipmentResponse($request, $soapResponse, 'requestTest',
                                                     MultiClient::LANGUAGE_LOCALE_GERMAN_DE);
        $actualResult = $response->hasNoErrors();

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @param object  $statusObject
     * @param boolean $expectedResult
     *
     * @dataProvider providerHasNoErrorsWithValidationState
     */
    public function testHasNoErrorsWithMultipleValidationStates($statusObject, $expectedResult) {
        $request                                  = new validateShipmentRequest([]);
        $soapResponse                             = $this->mockSoapResponseMultipleValidationStates();
        $soapResponse->ValidationState[1]->Status = $statusObject;

        $response     = new validateShipmentResponse($request, $soapResponse, 'requestTest',
                                                     MultiClient::LANGUAGE_LOCALE_GERMAN_DE);
        $actualResult = $response->hasNoErrors();

        $this->assertEquals($expectedResult, $actualResult);

        $soapResponse->ValidationState[0]->Status = $statusObject;

        $response2     = new validateShipmentResponse($request, $soapResponse, 'requestTest',
                                                      MultiClient::LANGUAGE_LOCALE_GERMAN_DE);
        $actualResult2 = $response2->hasNoErrors();

        $this->assertEquals($expectedResult, $actualResult2);
    }

    /**
     * @param object  $statusObject
     * @param boolean $expectedResult
     *
     * @dataProvider providerHasNoErrorsWithValidationState
     */
    public function testHasNoErrorsWithSingleValidationState($statusObject, $expectedResult) {
        $request                               = new validateShipmentRequest([]);
        $soapResponse                          = $this->mockSoapResponseSingleValidationState();
        $soapResponse->ValidationState->Status = $statusObject;

        $response     = new validateShipmentResponse($request, $soapResponse, 'requestTest',
                                                     MultiClient::LANGUAGE_LOCALE_GERMAN_DE);
        $actualResult = $response->hasNoErrors();

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @return object
     */
    private function mockSoapResponseEmptyValidationState() {
        return (object)[
            'Version'         => (object)[
                'majorRelease' => 3,
                'minorRelease' => 0
            ],
            'Status'          => (object)[
                'statusMessage' => 'ok'
            ],
            'ValidationState' => (object)[]
        ];
    }

    /**
     * @return object
     */
    private function mockSoapResponseMultipleValidationStates() {
        return (object)[
            'Version'         => (object)[
                'majorRelease' => 3,
                'minorRelease' => 0
            ],
            'Status'          => (object)[
                'statusMessage' => 'ok'
            ],
            'ValidationState' => [
                (object)[
                    'sequenceNumber' => 2,
                    'Status'         => (object)[
                        'statusMessage' => 'ok'
                    ]
                ],
                (object)[
                    'sequenceNumber' => 4,
                    'Status'         => (object)[
                        'statusMessage' => 'ok'
                    ]
                ],
                (object)[
                    'sequenceNumber' => 1,
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
    private function mockSoapResponseNoValidationState() {
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
    private function mockSoapResponseNullValidationState() {
        return (object)[
            'Version'         => (object)[
                'majorRelease' => 3,
                'minorRelease' => 0
            ],
            'Status'          => (object)[
                'statusMessage' => 'ok'
            ],
            'ValidationState' => NULL
        ];
    }

    /**
     * @return object
     */
    private function mockSoapResponseSingleValidationState() {
        return (object)[
            'Version'         => (object)[
                'majorRelease' => 3,
                'minorRelease' => 0
            ],
            'Status'          => (object)[
                'statusMessage' => 'ok'
            ],
            'ValidationState' => (object)[
                'sequenceNumber' => 2,
                'Status'         => (object)[
                    'statusMessage' => 'ok'
                ]
            ]
        ];
    }
}
