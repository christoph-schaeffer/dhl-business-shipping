<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Response;

use ChristophSchaeffer\Dhl\BusinessShipping\MultiClient;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource\Version;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\getLabel as getLabelResponse;
use ChristophSchaeffer\Dhl\BusinessShipping\Request\getLabel as getLabelRequest;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Data\LabelData;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Status\Success;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\AbstractUnitTest;

/**
 * Class getLabelTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test\Response
 */
class getLabelTest extends AbstractUnitTest {

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
    public function testConstructEmptyLabelData() {
        $request      = new getLabelRequest([]);
        $soapResponse = $this->mockSoapResponseEmptyLabelData();

        $response = new getLabelResponse($request, $soapResponse, 'requestTest',
                                         MultiClient::LANGUAGE_LOCALE_GERMAN_DE);

        $this->assertEquals($soapResponse, $response->rawResponse);
        $this->assertEquals('requestTest', $response->rawRequest);
        $this->assertEquals($request, $response->request);
        $this->assertInstanceOf(getLabelRequest::class, $response->request);

        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(3, $response->Version->majorRelease);
        $this->assertEquals(0, $response->Version->minorRelease);

        $this->assertEquals([(new Success('ok', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))], $response->Status);

        $this->assertTrue(is_array($response->LabelData));
        $this->assertCount(1, $response->LabelData);
        $labelData = array_shift($response->LabelData);

        $this->assertInstanceOf(LabelData::class, $labelData);
        $this->assertNull($labelData->Status);
        $this->assertNull($labelData->labelData);
        $this->assertNull($labelData->labelUrl);
        $this->assertNull($labelData->exportLabelData);
        $this->assertNull($labelData->exportLabelUrl);
        $this->assertNull($labelData->returnLabelData);
        $this->assertNull($labelData->returnLabelUrl);
        $this->assertNull($labelData->codLabelData);
        $this->assertNull($labelData->codLabelUrl);
    }

    /**
     *
     */
    public function testConstructMultipleLabelData() {
        $request      = new getLabelRequest([]);
        $soapResponse = $this->mockSoapResponseMultipleLabelData();

        $response = new getLabelResponse($request, $soapResponse, 'requestTest',
                                         MultiClient::LANGUAGE_LOCALE_GERMAN_DE);

        $this->assertEquals($soapResponse, $response->rawResponse);
        $this->assertEquals('requestTest', $response->rawRequest);
        $this->assertEquals($request, $response->request);
        $this->assertInstanceOf(getLabelRequest::class, $response->request);

        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(3, $response->Version->majorRelease);
        $this->assertEquals(0, $response->Version->minorRelease);

        $this->assertEquals([(new Success('ok', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))], $response->Status);

        $labelData1 = array_shift($response->LabelData);
        $this->assertInstanceOf(LabelData::class, $labelData1);
        $this->assertEquals($this->getMockedLabelData(), $labelData1);

        $labelData2 = array_shift($response->LabelData);
        $this->assertInstanceOf(LabelData::class, $labelData2);
        $this->assertEquals($this->getMockedLabelData(), $labelData2);

        $labelData3 = array_shift($response->LabelData);
        $this->assertInstanceOf(LabelData::class, $labelData3);
        $this->assertEquals($this->getMockedLabelData(), $labelData3);
    }

    /**
     *
     */
    public function testConstructNoLabelData() {
        $request      = new getLabelRequest([]);
        $soapResponse = $this->mockSoapResponseNoLabelData();

        $response = new getLabelResponse($request, $soapResponse, 'requestTest',
                                         MultiClient::LANGUAGE_LOCALE_GERMAN_DE);

        $this->assertEquals($soapResponse, $response->rawResponse);
        $this->assertEquals('requestTest', $response->rawRequest);
        $this->assertEquals($request, $response->request);
        $this->assertInstanceOf(getLabelRequest::class, $response->request);

        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(3, $response->Version->majorRelease);
        $this->assertEquals(0, $response->Version->minorRelease);

        $this->assertEquals([(new Success('ok', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))], $response->Status);

        $this->assertNull($response->LabelData);
    }

    /**
     *
     */
    public function testConstructNullLabelData() {
        $request      = new getLabelRequest([]);
        $soapResponse = $this->mockSoapResponseNullLabelData();

        $response = new getLabelResponse($request, $soapResponse, 'requestTest',
                                         MultiClient::LANGUAGE_LOCALE_GERMAN_DE);

        $this->assertEquals($soapResponse, $response->rawResponse);
        $this->assertEquals('requestTest', $response->rawRequest);
        $this->assertEquals($request, $response->request);
        $this->assertInstanceOf(getLabelRequest::class, $response->request);

        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(3, $response->Version->majorRelease);
        $this->assertEquals(0, $response->Version->minorRelease);

        $this->assertEquals([(new Success('ok', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))], $response->Status);

        $this->assertNull($response->LabelData);
    }

    /**
     *
     */
    public function testConstructSingleLabelData() {
        $request      = new getLabelRequest([]);
        $soapResponse = $this->mockSoapResponseSingleLabelData();

        $response = new getLabelResponse($request, $soapResponse, 'requestTest',
                                         MultiClient::LANGUAGE_LOCALE_GERMAN_DE);

        $this->assertEquals($soapResponse, $response->rawResponse);
        $this->assertEquals('requestTest', $response->rawRequest);
        $this->assertEquals($request, $response->request);
        $this->assertInstanceOf(getLabelRequest::class, $response->request);

        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(3, $response->Version->majorRelease);
        $this->assertEquals(0, $response->Version->minorRelease);

        $this->assertEquals([(new Success('ok', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))], $response->Status);

        $this->assertTrue(is_array($response->LabelData));
        $this->assertCount(1, $response->LabelData);
        $labelData = array_shift($response->LabelData);

        $this->assertInstanceOf(LabelData::class, $labelData);
        $this->assertEquals($this->getMockedLabelData(), $labelData);
    }

    /**
     * @param object  $statusObject
     * @param boolean $expectedResult
     *
     * @dataProvider providerHasNoErrorsWithEmptyLabelData
     */
    public function testHasNoErrorsWithEmptyLabelData($statusObject, $expectedResult) {
        $request              = new getLabelRequest([]);
        $soapResponse         = $this->mockSoapResponseEmptyLabelData();
        $soapResponse->Status = $statusObject;

        $response     = new getLabelResponse($request, $soapResponse, 'requestTest',
                                             MultiClient::LANGUAGE_LOCALE_GERMAN_DE);
        $actualResult = $response->hasNoErrors();

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @param object  $statusObject
     * @param boolean $expectedResult
     *
     * @dataProvider providerHasNoErrorsWithLabelData
     */
    public function testHasNoErrorsWithMultipleLabelDatas($statusObject, $expectedResult) {
        $request                            = new getLabelRequest([]);
        $soapResponse                       = $this->mockSoapResponseMultipleLabelData();
        $soapResponse->LabelData[1]->Status = $statusObject;

        $response     = new getLabelResponse($request, $soapResponse, 'requestTest',
                                             MultiClient::LANGUAGE_LOCALE_GERMAN_DE);
        $actualResult = $response->hasNoErrors();

        $this->assertEquals($expectedResult, $actualResult);

        $soapResponse->LabelData[0]->Status = $statusObject;

        $response2     = new getLabelResponse($request, $soapResponse, 'requestTest',
                                              MultiClient::LANGUAGE_LOCALE_GERMAN_DE);
        $actualResult2 = $response2->hasNoErrors();

        $this->assertEquals($expectedResult, $actualResult2);
    }

    /**
     * @param object  $statusObject
     * @param boolean $expectedResult
     *
     * @dataProvider providerHasNoErrorsWithLabelData
     */
    public function testHasNoErrorsWithSingleLabelData($statusObject, $expectedResult) {
        $request                         = new getLabelRequest([]);
        $soapResponse                    = $this->mockSoapResponseSingleLabelData();
        $soapResponse->LabelData->Status = $statusObject;

        $response     = new getLabelResponse($request, $soapResponse, 'requestTest',
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
    private function mockSoapResponseEmptyLabelData() {
        return (object)[
            'Version'   => (object)[
                'majorRelease' => 3,
                'minorRelease' => 0
            ],
            'Status'    => (object)[
                'statusMessage' => 'ok'
            ],
            'LabelData' => (object)[]
        ];
    }

    /**
     * @return object
     */
    private function mockSoapResponseMultipleLabelData() {
        return (object)[
            'Version'   => (object)[
                'majorRelease' => 3,
                'minorRelease' => 0
            ],
            'Status'    => (object)[
                'statusMessage' => 'ok'
            ],
            'LabelData' => [
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
            ]
        ];
    }

    /**
     * @return object
     */
    private function mockSoapResponseNoLabelData() {
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
    private function mockSoapResponseNullLabelData() {
        return (object)[
            'Version'   => (object)[
                'majorRelease' => 3,
                'minorRelease' => 0
            ],
            'Status'    => (object)[
                'statusMessage' => 'ok'
            ],
            'LabelData' => NULL
        ];
    }

    /**
     * @return object
     */
    private function mockSoapResponseSingleLabelData() {
        return (object)[
            'Version'   => (object)[
                'majorRelease' => 3,
                'minorRelease' => 0
            ],
            'Status'    => (object)[
                'statusMessage' => 'ok'
            ],
            'LabelData' => (object)[
                'Status' => (object)[
                    'statusMessage' => 'ok'
                ]
            ]
        ];
    }

}
