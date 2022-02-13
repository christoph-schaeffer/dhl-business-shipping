<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit\Response\Shipping;

use ChristophSchaeffer\Dhl\BusinessShipping\MultiClient;
use ChristophSchaeffer\Dhl\BusinessShipping\Request\Shipping\getManifest as getManifestRequest;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource\Version;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\getManifest as getManifestResponse;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\Success;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\AbstractUnitTest;

/**
 * Class getManifestTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test\Response
 */
class getManifestTest extends AbstractUnitTest {

    /**
     *
     */
    public function testConstructWithManifestData() {
        $request      = new getManifestRequest('2020-01-01');
        $soapResponse = $this->mockSoapResponseWithManifestData();

        $response = new getManifestResponse($request, $soapResponse, 'requestTest',
                                            MultiClient::LANGUAGE_LOCALE_GERMAN_DE);

        $this->assertEquals($soapResponse, $response->rawResponse);
        $this->assertEquals('requestTest', $response->rawRequest);
        $this->assertEquals($request, $response->request);
        $this->assertInstanceOf(getManifestRequest::class, $response->request);

        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(3, $response->Version->majorRelease);
        $this->assertEquals(0, $response->Version->minorRelease);

        $this->assertEquals([(new Success('ok', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))], $response->Status);

        $this->assertEquals('base64', $response->manifestData);
    }

    /**
     *
     */
    public function testConstructWithoutManifestData() {
        $request      = new getManifestRequest('2020-01-01');
        $soapResponse = $this->mockSoapResponseWithoutManifestData();

        $response = new getManifestResponse($request, $soapResponse, 'requestTest',
                                            MultiClient::LANGUAGE_LOCALE_GERMAN_DE);

        $this->assertEquals($soapResponse, $response->rawResponse);
        $this->assertEquals('requestTest', $response->rawRequest);
        $this->assertEquals($request, $response->request);
        $this->assertInstanceOf(getManifestRequest::class, $response->request);

        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(3, $response->Version->majorRelease);
        $this->assertEquals(0, $response->Version->minorRelease);

        $this->assertEquals(
            [(new Success('ok', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))],
            $response->Status
        );

        $this->assertNull($response->manifestData);
    }

    /**
     * @return object
     */
    private function mockSoapResponseWithManifestData() {
        return (object)[
            'Version'      => (object)[
                'majorRelease' => 3,
                'minorRelease' => 0
            ],
            'Status'       => (object)[
                'statusMessage' => 'ok'
            ],
            'manifestData' => 'base64' //has its own test
        ];
    }

    /**
     * @return object
     */
    private function mockSoapResponseWithoutManifestData() {
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
