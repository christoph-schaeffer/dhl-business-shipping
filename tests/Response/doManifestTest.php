<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Response;

use ChristophSchaeffer\Dhl\BusinessShipping\Client;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource\Version;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\doManifest as doManifestResponse;
use ChristophSchaeffer\Dhl\BusinessShipping\Request\doManifest as doManifestRequest;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\State\ManifestState;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Status\Success;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\AbstractUnitTest;

/**
 * Class doManifestTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test\Response
 */
class doManifestTest extends AbstractUnitTest {

    /**
     * @return array[]
     */
    public function providerHasNoErrorsWithEmptyManifestState() {
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
    public function providerHasNoErrorsWithManifestState() {
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
    public function testConstructEmptyManifestState() {
        $request      = new doManifestRequest([]);
        $soapResponse = $this->mockSoapResponseEmptyManifestState();

        $response = new doManifestResponse($request, $soapResponse, 'requestTest',
                                           Client::LANGUAGE_LOCALE_GERMAN_DE);

        $this->assertEquals($soapResponse, $response->rawResponse);
        $this->assertEquals('requestTest', $response->rawRequest);
        $this->assertEquals($request, $response->request);
        $this->assertInstanceOf(doManifestRequest::class, $response->request);

        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(3, $response->Version->majorRelease);
        $this->assertEquals(0, $response->Version->minorRelease);

        $this->assertEquals([(new Success('ok', Client::LANGUAGE_LOCALE_GERMAN_DE))], $response->Status);

        $this->assertTrue(is_array($response->ManifestStates));
        $this->assertCount(1, $response->ManifestStates);
        $manifestState = array_shift($response->ManifestStates);

        $this->assertInstanceOf(ManifestState::class, $manifestState);
        $this->assertNull($manifestState->shipmentNumber);
        $this->assertNull($manifestState->Status);
    }

    /**
     *
     */
    public function testConstructMultipleManifestStates() {
        $request      = new doManifestRequest([]);
        $soapResponse = $this->mockSoapResponseMultipleManifestStates();

        $response = new doManifestResponse($request, $soapResponse, 'requestTest',
                                           Client::LANGUAGE_LOCALE_GERMAN_DE);

        $this->assertEquals($soapResponse, $response->rawResponse);
        $this->assertEquals('requestTest', $response->rawRequest);
        $this->assertEquals($request, $response->request);
        $this->assertInstanceOf(doManifestRequest::class, $response->request);

        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(3, $response->Version->majorRelease);
        $this->assertEquals(0, $response->Version->minorRelease);

        $this->assertEquals([(new Success('ok', Client::LANGUAGE_LOCALE_GERMAN_DE))], $response->Status);

        $this->assertTrue(is_array($response->ManifestStates));
        $this->assertCount(3, $response->ManifestStates);

        $manifestState1 = array_shift($response->ManifestStates);
        $this->assertInstanceOf(ManifestState::class, $manifestState1);
        $this->assertEquals('1234567891', $manifestState1->shipmentNumber);
        $this->assertEquals([(new Success('ok', Client::LANGUAGE_LOCALE_GERMAN_DE))], $manifestState1->Status);

        $manifestState2 = array_shift($response->ManifestStates);
        $this->assertInstanceOf(ManifestState::class, $manifestState2);
        $this->assertEquals('1234567892', $manifestState2->shipmentNumber);
        $this->assertEquals([(new Success('ok', Client::LANGUAGE_LOCALE_GERMAN_DE))], $manifestState2->Status);

        $manifestState3 = array_shift($response->ManifestStates);
        $this->assertInstanceOf(ManifestState::class, $manifestState3);
        $this->assertEquals('1234567893', $manifestState3->shipmentNumber);
        $this->assertEquals([(new Success('ok', Client::LANGUAGE_LOCALE_GERMAN_DE))], $manifestState3->Status);
    }

    /**
     *
     */
    public function testConstructNoManifestState() {
        $request      = new doManifestRequest([]);
        $soapResponse = $this->mockSoapResponseNoManifestState();

        $response = new doManifestResponse($request, $soapResponse, 'requestTest',
                                           Client::LANGUAGE_LOCALE_GERMAN_DE);

        $this->assertEquals($soapResponse, $response->rawResponse);
        $this->assertEquals('requestTest', $response->rawRequest);
        $this->assertEquals($request, $response->request);
        $this->assertInstanceOf(doManifestRequest::class, $response->request);

        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(3, $response->Version->majorRelease);
        $this->assertEquals(0, $response->Version->minorRelease);

        $this->assertEquals([(new Success('ok', Client::LANGUAGE_LOCALE_GERMAN_DE))], $response->Status);

        $this->assertNull($response->ManifestStates);
    }

    /**
     *
     */
    public function testConstructNullManifestState() {
        $request      = new doManifestRequest([]);
        $soapResponse = $this->mockSoapResponseNullManifestState();

        $response = new doManifestResponse($request, $soapResponse, 'requestTest',
                                           Client::LANGUAGE_LOCALE_GERMAN_DE);

        $this->assertEquals($soapResponse, $response->rawResponse);
        $this->assertEquals('requestTest', $response->rawRequest);
        $this->assertEquals($request, $response->request);
        $this->assertInstanceOf(doManifestRequest::class, $response->request);

        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(3, $response->Version->majorRelease);
        $this->assertEquals(0, $response->Version->minorRelease);

        $this->assertEquals([(new Success('ok', Client::LANGUAGE_LOCALE_GERMAN_DE))], $response->Status);

        $this->assertNull($response->ManifestStates);
    }

    /**
     *
     */
    public function testConstructSingleManifestState() {
        $request      = new doManifestRequest([]);
        $soapResponse = $this->mockSoapResponseSingleManifestState();

        $response = new doManifestResponse($request, $soapResponse, 'requestTest',
                                           Client::LANGUAGE_LOCALE_GERMAN_DE);

        $this->assertEquals($soapResponse, $response->rawResponse);
        $this->assertEquals('requestTest', $response->rawRequest);
        $this->assertEquals($request, $response->request);
        $this->assertInstanceOf(doManifestRequest::class, $response->request);

        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(3, $response->Version->majorRelease);
        $this->assertEquals(0, $response->Version->minorRelease);

        $this->assertEquals([(new Success('ok', Client::LANGUAGE_LOCALE_GERMAN_DE))], $response->Status);

        $this->assertTrue(is_array($response->ManifestStates));
        $this->assertCount(1, $response->ManifestStates);
        $manifestState = array_shift($response->ManifestStates);

        $this->assertInstanceOf(ManifestState::class, $manifestState);
        $this->assertEquals('123456789', $manifestState->shipmentNumber);
        $this->assertEquals([(new Success('ok', Client::LANGUAGE_LOCALE_GERMAN_DE))], $manifestState->Status);
    }

    /**
     * @param object  $statusObject
     * @param boolean $expectedResult
     *
     * @dataProvider providerHasNoErrorsWithEmptyManifestState
     */
    public function testHasNoErrorsWithEmptyManifestState($statusObject, $expectedResult) {
        $request              = new doManifestRequest([]);
        $soapResponse         = $this->mockSoapResponseEmptyManifestState();
        $soapResponse->Status = $statusObject;

        $response     = new doManifestResponse($request, $soapResponse, 'requestTest',
                                               Client::LANGUAGE_LOCALE_GERMAN_DE);
        $actualResult = $response->hasNoErrors();

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @param object  $statusObject
     * @param boolean $expectedResult
     *
     * @dataProvider providerHasNoErrorsWithManifestState
     */
    public function testHasNoErrorsWithMultipleManifestStates($statusObject, $expectedResult) {
        $request                                = new doManifestRequest([]);
        $soapResponse                           = $this->mockSoapResponseMultipleManifestStates();
        $soapResponse->ManifestState[1]->Status = $statusObject;

        $response     = new doManifestResponse($request, $soapResponse, 'requestTest',
                                               Client::LANGUAGE_LOCALE_GERMAN_DE);
        $actualResult = $response->hasNoErrors();

        $this->assertEquals($expectedResult, $actualResult);

        $soapResponse->ManifestState[0]->Status = $statusObject;

        $response2     = new doManifestResponse($request, $soapResponse, 'requestTest',
                                                Client::LANGUAGE_LOCALE_GERMAN_DE);
        $actualResult2 = $response2->hasNoErrors();

        $this->assertEquals($expectedResult, $actualResult2);
    }

    /**
     * @param object  $statusObject
     * @param boolean $expectedResult
     *
     * @dataProvider providerHasNoErrorsWithManifestState
     */
    public function testHasNoErrorsWithSingleManifestState($statusObject, $expectedResult) {
        $request                             = new doManifestRequest([]);
        $soapResponse                        = $this->mockSoapResponseSingleManifestState();
        $soapResponse->ManifestState->Status = $statusObject;

        $response     = new doManifestResponse($request, $soapResponse, 'requestTest',
                                               Client::LANGUAGE_LOCALE_GERMAN_DE);
        $actualResult = $response->hasNoErrors();

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @return object
     */
    private function mockSoapResponseEmptyManifestState() {
        return (object)[
            'Version'       => (object)[
                'majorRelease' => 3,
                'minorRelease' => 0
            ],
            'Status'        => (object)[
                'statusMessage' => 'ok'
            ],
            'ManifestState' => (object)[]
        ];
    }

    /**
     * @return object
     */
    private function mockSoapResponseMultipleManifestStates() {
        return (object)[
            'Version'       => (object)[
                'majorRelease' => 3,
                'minorRelease' => 0
            ],
            'Status'        => (object)[
                'statusMessage' => 'ok'
            ],
            'ManifestState' => [
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
    private function mockSoapResponseNoManifestState() {
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
    private function mockSoapResponseNullManifestState() {
        return (object)[
            'Version'       => (object)[
                'majorRelease' => 3,
                'minorRelease' => 0
            ],
            'Status'        => (object)[
                'statusMessage' => 'ok'
            ],
            'ManifestState' => NULL
        ];
    }

    /**
     * @return object
     */
    private function mockSoapResponseSingleManifestState() {
        return (object)[
            'Version'       => (object)[
                'majorRelease' => 3,
                'minorRelease' => 0
            ],
            'Status'        => (object)[
                'statusMessage' => 'ok'
            ],
            'ManifestState' => (object)[
                'shipmentNumber' => '123456789',
                'Status'         => (object)[
                    'statusMessage' => 'ok'
                ]
            ]
        ];
    }
}
