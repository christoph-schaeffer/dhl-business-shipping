<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Integration;

use ChristophSchaeffer\Dhl\BusinessShipping\Credentials\TrackingClientCredentials;
use ChristophSchaeffer\Dhl\BusinessShipping\Protocol\Rest;
use ChristophSchaeffer\Dhl\BusinessShipping\Request;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource\Version;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking\Data\PieceShipment;
use ChristophSchaeffer\Dhl\BusinessShipping\TrackingClient;

/**
 * Class TrackingClientIntegrationTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test\Integration
 */
class TrackingClientIntegrationTest extends AbstractIntegrationTest {

    const APP_ID    = 'appIDTest';
    const API_TOKEN = 'apiTokenTest';
    const ZT_TOKEN  = 'ztTokenTest';
    const PASSWORD  = 'passwordTest';

    public function testIntegrationGetPiece() {
        //given
        $pieceCode                = '00340434161094042557';
        $languageLocale           = 'de';
        $expectedXmlRequestString = '<?xml version="1.0" encoding="ISO-8859-1" ?><data piece-code="'.$pieceCode.'" appname="'.self::ZT_TOKEN.'" password="'.self::PASSWORD.'" language-code="'.$languageLocale.'" request="d-get-piece"></data>';
        $xmlResponseStringMock    = '<?xml version="1.0" encoding="UTF-8"?><data name="piece-shipment-list" request-id="c2d27a0e-7c26-4d20-84dc-c94610b55a28" code="0"><data name="piece-shipment" error-status="0" piece-id="fc23a3ec-cca6-483e-8fd5-c927ab0e2b1b" shipment-code="" piece-identifier="340434161094042557" identifier-type="2" piece-code="00340434161094042557" event-location="" event-country="DE" status-liste="0" status-timestamp="18.03.2016 10:02" status="Die Sendung wurde erfolgreich zugestellt." short-status="Zustellung erfolgreich" recipient-name="Kraemer" recipient-street="Heinrich-Brüning-Str. 7" recipient-city="53113 Bonn" pan-recipient-name="Deutsche Post DHL" pan-recipient-street="Heinrich-Brüning-Str. 7" pan-recipient-city="53113 Bonn" pan-recipient-address="Heinrich-Brüning-Str. 7 53113 Bonn" pan-recipient-postalcode="53113" shipper-name="Es wurden keine Absender-Daten an DHL übermittelt." shipper-street="" shipper-city="" shipper-address="" product-code="00" product-key="" product-name="DHL PAKET" delivery-event-flag="1" recipient-id="5" recipient-id-text="andere anwesende Person" upu="" shipment-length="0.0" shipment-width="0.0" shipment-height="0.0" shipment-weight="0.0" international-flag="0" division="DPEED" ice="DLVRD" ric="OTHER" standard-event-code="ZU" dest-country="DE" origin-country="DE" searched-piece-code="00340434161094042557" searched-ref-no="" piece-customer-reference="" shipment-customer-reference="" leitcode="" routing-code-ean="" matchcode="" domestic-id="" airway-bill-number="" ruecksendung="false" pslz-nr="5066847896" order-preferred-delivery-day="false" /></data>';
        $client                   = $this->getClient($xmlResponseStringMock, $languageLocale);
        $requestObject            = new Request\Tracking\getPiece();
        $requestObject->pieceCode = $pieceCode;

        //when
        $response = $client->getPiece($requestObject);

        //then
        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(TrackingClient::MAJOR_RELEASE, $response->Version->majorRelease);
        $this->assertEquals(TrackingClient::MINOR_RELEASE, $response->Version->minorRelease);

        $this->assertInstanceOf(Request\Tracking\getPiece::class, $response->request);
        $this->assertEquals('d-get-piece', $response->request->request);
        $this->assertEquals(self::ZT_TOKEN, $response->request->appname);
        $this->assertEquals(self::PASSWORD, $response->request->password);
        $this->assertEquals($languageLocale, $response->request->languageCode);
        $this->assertEquals($pieceCode, $response->request->pieceCode);

        $this->assertEquals('c2d27a0e-7c26-4d20-84dc-c94610b55a28', $response->requestId);
        $this->assertEquals(0, $response->code);
        $this->assertEquals($expectedXmlRequestString, $response->rawRequest);
        $this->assertEquals(simplexml_load_string($xmlResponseStringMock), $response->rawResponse);

        $this->assertInstanceOf(PieceShipment::class, $response->pieceShipment);
        $this->assertEquals(0, $response->pieceShipment->errorStatus);
        $this->assertEquals('fc23a3ec-cca6-483e-8fd5-c927ab0e2b1b', $response->pieceShipment->pieceId);
        $this->assertEquals('', $response->pieceShipment->shipmentCode);
        $this->assertEquals('340434161094042557', $response->pieceShipment->pieceIdentifier);
        $this->assertEquals(2, $response->pieceShipment->identifierType);
        $this->assertEquals('00340434161094042557', $response->pieceShipment->pieceCode);
        $this->assertEquals('', $response->pieceShipment->eventLocation);
        $this->assertEquals('DE', $response->pieceShipment->eventCountry);
        $this->assertEquals('0', $response->pieceShipment->statusListe);
        $this->assertEquals('18.03.2016 10:02', $response->pieceShipment->statusTimestamp);
        $this->assertEquals('Die Sendung wurde erfolgreich zugestellt.', $response->pieceShipment->status);
        $this->assertEquals('Zustellung erfolgreich', $response->pieceShipment->shortStatus);
        $this->assertEquals('Kraemer', $response->pieceShipment->recipientName);
        $this->assertEquals('Heinrich-Brüning-Str. 7', $response->pieceShipment->recipientStreet);
        $this->assertEquals('53113 Bonn', $response->pieceShipment->recipientCity);
        $this->assertEquals('Deutsche Post DHL', $response->pieceShipment->panRecipientName);
        $this->assertEquals('Heinrich-Brüning-Str. 7', $response->pieceShipment->panRecipientStreet);
        $this->assertEquals('53113 Bonn', $response->pieceShipment->panRecipientCity);
        $this->assertEquals('Heinrich-Brüning-Str. 7 53113 Bonn', $response->pieceShipment->panRecipientAddress);
        $this->assertEquals('53113', $response->pieceShipment->panRecipientPostalcode);
        $this->assertEquals('Es wurden keine Absender-Daten an DHL übermittelt.', $response->pieceShipment->shipperName);
        $this->assertEquals('', $response->pieceShipment->shipperStreet);
        $this->assertEquals('', $response->pieceShipment->shipperCity);
        $this->assertEquals('', $response->pieceShipment->shipperAddress);
        $this->assertEquals('00', $response->pieceShipment->productCode);
        $this->assertEquals('', $response->pieceShipment->productKey);
        $this->assertEquals('DHL PAKET', $response->pieceShipment->productName);
        $this->assertEquals(TRUE, $response->pieceShipment->deliveryEventFlag);
        $this->assertEquals(5, $response->pieceShipment->recipientId);
        $this->assertEquals('andere anwesende Person', $response->pieceShipment->recipientIdText);
        $this->assertEquals('', $response->pieceShipment->upu);
        $this->assertEquals(0.0, $response->pieceShipment->shipmentLength);
        $this->assertEquals(0.0, $response->pieceShipment->shipmentWidth);
        $this->assertEquals(0.0, $response->pieceShipment->shipmentHeight);
        $this->assertEquals(0.0, $response->pieceShipment->shipmentWeight);
        $this->assertEquals(FALSE, $response->pieceShipment->internationalFlag);
        $this->assertEquals('DPEED', $response->pieceShipment->division);
        $this->assertEquals('DLVRD', $response->pieceShipment->ice);
        $this->assertEquals('OTHER', $response->pieceShipment->ric);
        $this->assertEquals('ZU', $response->pieceShipment->standardEventCode);
        $this->assertEquals('DE', $response->pieceShipment->destCountry);
        $this->assertEquals('DE', $response->pieceShipment->originCountry);
        $this->assertEquals('00340434161094042557', $response->pieceShipment->searchedPieceCode);
        $this->assertEquals('', $response->pieceShipment->searchedRefNr);
        $this->assertEquals('', $response->pieceShipment->pieceCustomerReference);
        $this->assertEquals('', $response->pieceShipment->shipmentCustomerReference);
        $this->assertEquals('', $response->pieceShipment->leitcode);
        $this->assertEquals('', $response->pieceShipment->routingCodeEan);
        $this->assertEquals('', $response->pieceShipment->matchcode);
        $this->assertEquals('', $response->pieceShipment->domesticId);
        $this->assertEquals('', $response->pieceShipment->airwayBillNumber);
        $this->assertEquals(FALSE, $response->pieceShipment->ruecksendung);
        $this->assertEquals('5066847896', $response->pieceShipment->pslzNr);
        $this->assertEquals(FALSE, $response->pieceShipment->orderPreferredDeliveryDay);
        $this->assertEquals([], $response->pieceShipment->pieceEventList);
    }

    /**
     * @param string $expectedXmlResponseString
     * @param string $languageLocale
     * @return TrackingClient
     */
    private function getClient($expectedXmlResponseString, $languageLocale = 'DE') {
        $isSandbox = TRUE;

        $restMock = $this->getMockBuilder(Rest::class)
            ->setConstructorArgs([self::APP_ID, self::API_TOKEN, $isSandbox])
            ->setMethods(['callRestFunction'])
            ->getMock();
        $restMock->method('callRestFunction')
            ->willReturn($expectedXmlResponseString);


        $credentials = new TrackingClientCredentials(self::APP_ID, self::API_TOKEN, self::ZT_TOKEN, self::PASSWORD);

        return new TrackingClient($credentials, $isSandbox, $languageLocale, $restMock);
    }

}