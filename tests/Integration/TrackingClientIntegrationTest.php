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
        $languageLocale           = 'de';
        $xmlResponseString         = '<?xml version="1.0" encoding="UTF-8"?><data name="piece-shipment-list" request-id="c2d27a0e-7c26-4d20-84dc-c94610b55a28" code="0"><data name="piece-shipment" error-status="0" piece-id="fc23a3ec-cca6-483e-8fd5-c927ab0e2b1b" shipment-code="" piece-identifier="340434161094042557" identifier-type="2" piece-code="00340434161094042557" event-location="" event-country="DE" status-liste="0" status-timestamp="18.03.2016 10:02" status="Die Sendung wurde erfolgreich zugestellt." short-status="Zustellung erfolgreich" recipient-name="Kraemer" recipient-street="Heinrich-Brüning-Str. 7" recipient-city="53113 Bonn" pan-recipient-name="Deutsche Post DHL" pan-recipient-street="Heinrich-Brüning-Str. 7" pan-recipient-city="53113 Bonn" pan-recipient-address="Heinrich-Brüning-Str. 7 53113 Bonn" pan-recipient-postalcode="53113" shipper-name="Es wurden keine Absender-Daten an DHL übermittelt." shipper-street="" shipper-city="" shipper-address="" product-code="00" product-key="" product-name="DHL PAKET" delivery-event-flag="1" recipient-id="5" recipient-id-text="andere anwesende Person" upu="" shipment-length="0.0" shipment-width="0.0" shipment-height="0.0" shipment-weight="0.0" international-flag="0" division="DPEED" ice="DLVRD" ric="OTHER" standard-event-code="ZU" dest-country="DE" origin-country="DE" searched-piece-code="00340434161094042557" searched-ref-no="" piece-customer-reference="" shipment-customer-reference="" leitcode="" routing-code-ean="" matchcode="" domestic-id="" airway-bill-number="" ruecksendung="false" pslz-nr="5066847896" order-preferred-delivery-day="false" /></data>';
        $client                   = $this->getClient($xmlResponseString, $languageLocale);
        $requestObject            = new Request\Tracking\getPiece();
        $requestObject->pieceCode = '00340434161094042557';

        //when
        $response = $client->getPiece($requestObject);

        //then
        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals($response->Version->majorRelease, TrackingClient::MAJOR_RELEASE);
        $this->assertEquals($response->Version->minorRelease, TrackingClient::MINOR_RELEASE);

        $this->assertEquals($response->request->request, 'd-get-piece');
        $this->assertEquals($response->request->appname, self::ZT_TOKEN);
        $this->assertEquals($response->request->password, self::PASSWORD);
        $this->assertEquals($response->request->languageCode, $languageLocale);

        $this->assertEquals($response->requestId, 'c2d27a0e-7c26-4d20-84dc-c94610b55a28');
        $this->assertEquals($response->code, 0);

        $this->assertInstanceOf(PieceShipment::class, $response->pieceShipment);
        $this->assertEquals($response->pieceShipment->errorStatus, 0);
        $this->assertEquals($response->pieceShipment->pieceId, 'fc23a3ec-cca6-483e-8fd5-c927ab0e2b1b');
        $this->assertEquals($response->pieceShipment->shipmentCode, '');
        $this->assertEquals($response->pieceShipment->pieceIdentifier, '340434161094042557');
        $this->assertEquals($response->pieceShipment->identifierType, 2);
        $this->assertEquals($response->pieceShipment->pieceCode, '00340434161094042557');
        $this->assertEquals($response->pieceShipment->eventLocation, '');
        $this->assertEquals($response->pieceShipment->eventCountry, 'DE');
        $this->assertEquals($response->pieceShipment->statusListe, '0');
        $this->assertEquals($response->pieceShipment->statusTimestamp, '18.03.2016 10:02');
        $this->assertEquals($response->pieceShipment->status, 'Die Sendung wurde erfolgreich zugestellt.');
        $this->assertEquals($response->pieceShipment->shortStatus, 'Zustellung erfolgreich');
        $this->assertEquals($response->pieceShipment->recipientName, 'Kraemer');
        $this->assertEquals($response->pieceShipment->recipientStreet, 'Heinrich-Brüning-Str. 7');
        $this->assertEquals($response->pieceShipment->recipientCity, '53113 Bonn');
        $this->assertEquals($response->pieceShipment->panRecipientName, 'Deutsche Post DHL');
        $this->assertEquals($response->pieceShipment->panRecipientStreet, 'Heinrich-Brüning-Str. 7');
        $this->assertEquals($response->pieceShipment->panRecipientCity, '53113 Bonn');
        $this->assertEquals($response->pieceShipment->panRecipientAddress, 'Heinrich-Brüning-Str. 7 53113 Bonn');
        $this->assertEquals($response->pieceShipment->panRecipientPostalcode, '53113');
        $this->assertEquals($response->pieceShipment->shipperName, 'Es wurden keine Absender-Daten an DHL übermittelt.');
        $this->assertEquals($response->pieceShipment->shipperStreet, '');
        $this->assertEquals($response->pieceShipment->shipperCity, '');
        $this->assertEquals($response->pieceShipment->shipperAddress, '');
        $this->assertEquals($response->pieceShipment->productCode, '00');
        $this->assertEquals($response->pieceShipment->productKey, '');
        $this->assertEquals($response->pieceShipment->productName, 'DHL PAKET');
        $this->assertEquals($response->pieceShipment->deliveryEventFlag, TRUE);
        $this->assertEquals($response->pieceShipment->recipientId, 5);
        $this->assertEquals($response->pieceShipment->recipientIdText, 'andere anwesende Person');
        $this->assertEquals($response->pieceShipment->upu, '');
        $this->assertEquals($response->pieceShipment->shipmentLength, 0.0);
        $this->assertEquals($response->pieceShipment->shipmentWidth, 0.0);
        $this->assertEquals($response->pieceShipment->shipmentHeight, 0.0);
        $this->assertEquals($response->pieceShipment->shipmentWeight, 0.0);
        $this->assertEquals($response->pieceShipment->internationalFlag, FALSE);
        $this->assertEquals($response->pieceShipment->division, 'DPEED');
        $this->assertEquals($response->pieceShipment->ice, 'DLVRD');
        $this->assertEquals($response->pieceShipment->ric, 'OTHER');
        $this->assertEquals($response->pieceShipment->standardEventCode, 'ZU');
        $this->assertEquals($response->pieceShipment->destCountry, 'DE');
        $this->assertEquals($response->pieceShipment->originCountry, 'DE');
        $this->assertEquals($response->pieceShipment->searchedPieceCode, '00340434161094042557');
        $this->assertEquals($response->pieceShipment->searchedRefNr, '');
        $this->assertEquals($response->pieceShipment->pieceCustomerReference, '');
        $this->assertEquals($response->pieceShipment->shipmentCustomerReference, '');
        $this->assertEquals($response->pieceShipment->leitcode, '');
        $this->assertEquals($response->pieceShipment->routingCodeEan, '');
        $this->assertEquals($response->pieceShipment->matchcode, '');
        $this->assertEquals($response->pieceShipment->domesticId, '');
        $this->assertEquals($response->pieceShipment->airwayBillNumber, '');
        $this->assertEquals($response->pieceShipment->ruecksendung, FALSE);
        $this->assertEquals($response->pieceShipment->pslzNr, '5066847896');
        $this->assertEquals($response->pieceShipment->orderPreferredDeliveryDay, FALSE);
        $this->assertEquals($response->pieceShipment->pieceEventList, []);

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