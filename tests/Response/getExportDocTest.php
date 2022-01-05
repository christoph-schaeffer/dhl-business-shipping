<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Response;

use ChristophSchaeffer\Dhl\BusinessShipping\MultiClient;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource\Version;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\getExportDoc as getExportDocResponse;
use ChristophSchaeffer\Dhl\BusinessShipping\Request\getExportDoc as getExportDocRequest;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Data\ExportDocData;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Status\Success;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\AbstractUnitTest;

/**
 * Class getExportDocTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test\Response
 */
class getExportDocTest extends AbstractUnitTest {

    /**
     * @return array[]
     */
    public function providerHasNoErrorsWithEmptyExportDocData() {
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
    public function providerHasNoErrorsWithExportDocData() {
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
    public function testConstructEmptyExportDocData() {
        $request      = new getExportDocRequest([]);
        $soapResponse = $this->mockSoapResponseEmptyExportDocData();

        $response = new getExportDocResponse($request, $soapResponse, 'requestTest',
                                             MultiClient::LANGUAGE_LOCALE_GERMAN_DE);

        $this->assertEquals($soapResponse, $response->rawResponse);
        $this->assertEquals('requestTest', $response->rawRequest);
        $this->assertEquals($request, $response->request);
        $this->assertInstanceOf(getExportDocRequest::class, $response->request);

        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(3, $response->Version->majorRelease);
        $this->assertEquals(0, $response->Version->minorRelease);

        $this->assertEquals([(new Success('ok', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))], $response->Status);

        $this->assertTrue(is_array($response->ExportDocData));
        $this->assertCount(1, $response->ExportDocData);
        $exportDocData = array_shift($response->ExportDocData);

        $this->assertInstanceOf(ExportDocData::class, $exportDocData);
        $this->assertNull($exportDocData->Status);
        $this->assertNull($exportDocData->exportDocData);
        $this->assertNull($exportDocData->exportDocUrl);
    }

    /**
     *
     */
    public function testConstructMultipleExportDocData() {
        $request      = new getExportDocRequest([]);
        $soapResponse = $this->mockSoapResponseMultipleExportDocData();

        $response = new getExportDocResponse($request, $soapResponse, 'requestTest',
                                             MultiClient::LANGUAGE_LOCALE_GERMAN_DE);

        $this->assertEquals($soapResponse, $response->rawResponse);
        $this->assertEquals('requestTest', $response->rawRequest);
        $this->assertEquals($request, $response->request);
        $this->assertInstanceOf(getExportDocRequest::class, $response->request);

        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(3, $response->Version->majorRelease);
        $this->assertEquals(0, $response->Version->minorRelease);

        $this->assertEquals([(new Success('ok', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))], $response->Status);

        $exportDocData1 = array_shift($response->ExportDocData);
        $this->assertInstanceOf(ExportDocData::class, $exportDocData1);
        $this->assertEquals($this->getMockedExportData(), $exportDocData1);

        $exportDocData2 = array_shift($response->ExportDocData);
        $this->assertInstanceOf(ExportDocData::class, $exportDocData2);
        $this->assertEquals($this->getMockedExportData(), $exportDocData2);

        $exportDocData3 = array_shift($response->ExportDocData);
        $this->assertInstanceOf(ExportDocData::class, $exportDocData3);
        $this->assertEquals($this->getMockedExportData(), $exportDocData3);
    }

    /**
     *
     */
    public function testConstructNoExportDocData() {
        $request      = new getExportDocRequest([]);
        $soapResponse = $this->mockSoapResponseNoExportDocData();

        $response = new getExportDocResponse($request, $soapResponse, 'requestTest',
                                             MultiClient::LANGUAGE_LOCALE_GERMAN_DE);

        $this->assertEquals($soapResponse, $response->rawResponse);
        $this->assertEquals('requestTest', $response->rawRequest);
        $this->assertEquals($request, $response->request);
        $this->assertInstanceOf(getExportDocRequest::class, $response->request);

        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(3, $response->Version->majorRelease);
        $this->assertEquals(0, $response->Version->minorRelease);

        $this->assertEquals([(new Success('ok', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))], $response->Status);

        $this->assertNull($response->ExportDocData);
    }

    /**
     *
     */
    public function testConstructNullExportDocData() {
        $request      = new getExportDocRequest([]);
        $soapResponse = $this->mockSoapResponseNullExportDocData();

        $response = new getExportDocResponse($request, $soapResponse, 'requestTest',
                                             MultiClient::LANGUAGE_LOCALE_GERMAN_DE);

        $this->assertEquals($soapResponse, $response->rawResponse);
        $this->assertEquals('requestTest', $response->rawRequest);
        $this->assertEquals($request, $response->request);
        $this->assertInstanceOf(getExportDocRequest::class, $response->request);

        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(3, $response->Version->majorRelease);
        $this->assertEquals(0, $response->Version->minorRelease);

        $this->assertEquals([(new Success('ok', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))], $response->Status);

        $this->assertNull($response->ExportDocData);
    }

    /**
     *
     */
    public function testConstructSingleExportDocData() {
        $request      = new getExportDocRequest([]);
        $soapResponse = $this->mockSoapResponseSingleExportDocData();

        $response = new getExportDocResponse($request, $soapResponse, 'requestTest',
                                             MultiClient::LANGUAGE_LOCALE_GERMAN_DE);

        $this->assertEquals($soapResponse, $response->rawResponse);
        $this->assertEquals('requestTest', $response->rawRequest);
        $this->assertEquals($request, $response->request);
        $this->assertInstanceOf(getExportDocRequest::class, $response->request);

        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(3, $response->Version->majorRelease);
        $this->assertEquals(0, $response->Version->minorRelease);

        $this->assertEquals([(new Success('ok', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))], $response->Status);

        $this->assertTrue(is_array($response->ExportDocData));
        $this->assertCount(1, $response->ExportDocData);
        $exportDocData = array_shift($response->ExportDocData);

        $this->assertInstanceOf(ExportDocData::class, $exportDocData);
        $this->assertEquals($this->getMockedExportData(), $exportDocData);
    }

    /**
     * @param object  $statusObject
     * @param boolean $expectedResult
     *
     * @dataProvider providerHasNoErrorsWithEmptyExportDocData
     */
    public function testHasNoErrorsWithEmptyExportDocData($statusObject, $expectedResult) {
        $request              = new getExportDocRequest([]);
        $soapResponse         = $this->mockSoapResponseEmptyExportDocData();
        $soapResponse->Status = $statusObject;

        $response     = new getExportDocResponse($request, $soapResponse, 'requestTest',
                                                 MultiClient::LANGUAGE_LOCALE_GERMAN_DE);
        $actualResult = $response->hasNoErrors();

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @param object  $statusObject
     * @param boolean $expectedResult
     *
     * @dataProvider providerHasNoErrorsWithExportDocData
     */
    public function testHasNoErrorsWithMultipleExportDocDatas($statusObject, $expectedResult) {
        $request                                = new getExportDocRequest([]);
        $soapResponse                           = $this->mockSoapResponseMultipleExportDocData();
        $soapResponse->ExportDocData[1]->Status = $statusObject;

        $response     = new getExportDocResponse($request, $soapResponse, 'requestTest',
                                                 MultiClient::LANGUAGE_LOCALE_GERMAN_DE);
        $actualResult = $response->hasNoErrors();

        $this->assertEquals($expectedResult, $actualResult);

        $soapResponse->ExportDocData[0]->Status = $statusObject;

        $response2     = new getExportDocResponse($request, $soapResponse, 'requestTest',
                                                  MultiClient::LANGUAGE_LOCALE_GERMAN_DE);
        $actualResult2 = $response2->hasNoErrors();

        $this->assertEquals($expectedResult, $actualResult2);
    }

    /**
     * @param object  $statusObject
     * @param boolean $expectedResult
     *
     * @dataProvider providerHasNoErrorsWithExportDocData
     */
    public function testHasNoErrorsWithSingleExportDocData($statusObject, $expectedResult) {
        $request                             = new getExportDocRequest([]);
        $soapResponse                        = $this->mockSoapResponseSingleExportDocData();
        $soapResponse->ExportDocData->Status = $statusObject;

        $response     = new getExportDocResponse($request, $soapResponse, 'requestTest',
                                                 MultiClient::LANGUAGE_LOCALE_GERMAN_DE);
        $actualResult = $response->hasNoErrors();

        $this->assertEquals($expectedResult, $actualResult);
    }

    private function getMockedExportData() {
        return new ExportDocData(
            MultiClient::LANGUAGE_LOCALE_GERMAN_DE,
            (object)['Status' => (object)['statusText' => 'ok']]
        );
    }

    /**
     * @return object
     */
    private function mockSoapResponseEmptyExportDocData() {
        return (object)[
            'Version'       => (object)[
                'majorRelease' => 3,
                'minorRelease' => 0
            ],
            'Status'        => (object)[
                'statusMessage' => 'ok'
            ],
            'ExportDocData' => (object)[]
        ];
    }

    /**
     * @return object
     */
    private function mockSoapResponseMultipleExportDocData() {
        return (object)[
            'Version'       => (object)[
                'majorRelease' => 3,
                'minorRelease' => 0
            ],
            'Status'        => (object)[
                'statusMessage' => 'ok'
            ],
            'ExportDocData' => [
                (object)[
                    'Status' => (object)[
                        'statusMessage' => 'ok'
                    ]
                ], (object)[
                    'Status' => (object)[
                        'statusMessage' => 'ok'
                    ]
                ], (object)[
                    'Status' => (object)[
                        'statusMessage' => 'ok'
                    ]
                ]
            ] //has its own test
        ];
    }

    /**
     * @return object
     */
    private function mockSoapResponseNoExportDocData() {
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
    private function mockSoapResponseNullExportDocData() {
        return (object)[
            'Version'       => (object)[
                'majorRelease' => 3,
                'minorRelease' => 0
            ],
            'Status'        => (object)[
                'statusMessage' => 'ok'
            ],
            'ExportDocData' => NULL
        ];
    }

    /**
     * @return object
     */
    private function mockSoapResponseSingleExportDocData() {
        return (object)[
            'Version'       => (object)[
                'majorRelease' => 3,
                'minorRelease' => 0
            ],
            'Status'        => (object)[
                'statusMessage' => 'ok'
            ],
            'ExportDocData' => (object)[
                'Status' => (object)[
                    'statusMessage' => 'ok'
                ]
            ]
        ];
    }

}
