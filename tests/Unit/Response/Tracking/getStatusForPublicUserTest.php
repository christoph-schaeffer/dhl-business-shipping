<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit\Response\Tracking;

use ChristophSchaeffer\Dhl\BusinessShipping\Resource\Version;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\AbstractTrackingResponse;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit\AbstractUnitTest;
use ChristophSchaeffer\Dhl\BusinessShipping\TrackingClient;
use ChristophSchaeffer\Dhl\BusinessShipping\Response;
use ChristophSchaeffer\Dhl\BusinessShipping\Request;

/**
 * Class getStatusForPublicUserTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test\Unit\Response\Tracking
 */
class getStatusForPublicUserTest extends AbstractUnitTest {

    public function testConstructWithCode100WithoutErrorResponse() {
        $request      = new Request\Tracking\getStatusForPublicUser(['420']);
        $restResponse =  simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><data request-id="1337"><data code="100"></data></data>');

        $responseDe = new Response\Tracking\getStatusForPublicUser($request, $restResponse, 'rawRequestTest', 'de');
        $this->commonAssertions($responseDe, $restResponse, 100,FALSE);
        $this->assertEquals('Es ist ein unbekannter Fehler aufgetreten', $responseDe->error);

        $responseEn = new Response\Tracking\getStatusForPublicUser($request, $restResponse, 'rawRequestTest', 'en');
        $this->commonAssertions($responseEn, $restResponse, 100,FALSE);
        $this->assertEquals('An unknown error occurred', $responseEn->error);
    }

    /**
     * @param AbstractTrackingResponse $response
     * @param \SimpleXMLElement $restResponse
     * @param bool $hasNoErrors
     * @return void
     */
    private function commonAssertions($response, $restResponse, $code, $hasNoErrors = TRUE) {
        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(TrackingClient::MAJOR_RELEASE, $response->Version->majorRelease);
        $this->assertEquals(TrackingClient::MINOR_RELEASE, $response->Version->minorRelease);

        $this->assertEquals('rawRequestTest', $response->rawRequest);
        $this->assertEquals($restResponse, $response->rawResponse);

        $this->assertEquals($code, $response->code);
        $this->assertEquals('1337', $response->requestId);
        $this->assertEquals($hasNoErrors, $response->hasNoErrors());
    }
}
