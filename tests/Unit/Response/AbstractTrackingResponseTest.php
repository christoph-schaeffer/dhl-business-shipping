<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit\Response;

use ChristophSchaeffer\Dhl\BusinessShipping\Request\AbstractTrackingRequest;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource\Version;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\AbstractTrackingResponse;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit\AbstractUnitTest;
use ChristophSchaeffer\Dhl\BusinessShipping\TrackingClient;

/**
 * Class AbstractTrackingResponseTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test\Unit\Response
 */
class AbstractTrackingResponseTest extends AbstractUnitTest {

    public function testConstruct() {
        $request      = $this->getMockForAbstractClass(AbstractTrackingRequest::class);
        $restResponse =  simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><data code="0" request-id="1337"><data piece-code="420"/></data>');
        $response = $this->getMockedResponse($request, $restResponse);

        $this->commonAssertions($response, $restResponse, 0,TRUE);
        $this->assertEquals(null, $response->error);
    }

    public function testConstructWithErrorResponse() {
        $request      = $this->getMockForAbstractClass(AbstractTrackingRequest::class);
        $restResponse =  simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><data code="100" request-id="1337" error="Keine Daten gefunden."></data>');
        $response = $this->getMockedResponse($request, $restResponse);

        $this->commonAssertions($response, $restResponse, 100,FALSE);
        $this->assertEquals('Keine Daten gefunden.', $response->error);
    }

    public function testConstructWithCode0WithErrorResponse() {
        $request      = $this->getMockForAbstractClass(AbstractTrackingRequest::class);
        $restResponse =  simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><data code="0" error="Failed successfully" request-id="1337"></data>');
        $response = $this->getMockedResponse($request, $restResponse, 'en');

        $this->commonAssertions($response, $restResponse, 0,FALSE);
        $this->assertEquals('Failed successfully', $response->error);
    }

    /**
     * @param AbstractTrackingRequest $request
     * @param \SimpleXMLElement $restResponse
     * @param string $languageLocale
     * @return AbstractTrackingResponse|\PHPUnit_Framework_MockObject_MockObject
     */
    private function getMockedResponse($request, $restResponse, $languageLocale = 'de') {
        return $this->getMockForAbstractClass(AbstractTrackingResponse::class,
            [ $request, $restResponse, 'rawRequestTest', $languageLocale]);
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
