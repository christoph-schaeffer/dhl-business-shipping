<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit\Response\Shipping;

use ChristophSchaeffer\Dhl\BusinessShipping\MultiClient;
use ChristophSchaeffer\Dhl\BusinessShipping\Request\Shipping\getVersion as getVersionRequest;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource\Version;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\getVersion as getVersionResponse;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\Success;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit\AbstractUnitTest;

/**
 * Class getVersionTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test\Unit\Response\Shipping
 */
class getVersionTest extends AbstractUnitTest {

    /**
     *
     */
    public function testConstruct() {
        $request      = new getVersionRequest();
        $soapResponse = $this->mockSoapResponse();

        $response = new getVersionResponse($request, $soapResponse, 'requestTest',
                                           MultiClient::LANGUAGE_LOCALE_GERMAN_DE);

        $this->assertEquals($soapResponse, $response->rawResponse);
        $this->assertEquals('requestTest', $response->rawRequest);
        $this->assertEquals($request, $response->request);
        $this->assertInstanceOf(getVersionRequest::class, $response->request);

        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(3, $response->Version->majorRelease);
        $this->assertEquals(0, $response->Version->minorRelease);

        $this->assertEquals([(new Success('ok', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))], $response->Status);
    }

    /**
     * @return object
     */
    private function mockSoapResponse() {
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
