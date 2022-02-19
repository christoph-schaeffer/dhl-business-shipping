<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Integration;

use ChristophSchaeffer\Dhl\BusinessShipping\Credentials\TrackingClientCredentials;
use ChristophSchaeffer\Dhl\BusinessShipping\Protocol\Rest;
use ChristophSchaeffer\Dhl\BusinessShipping\Request;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource\Tracking\PieceData;
use ChristophSchaeffer\Dhl\BusinessShipping\Resource\Version;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\AbstractTrackingResponse;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking\Data\PieceEvent;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking\Data\PieceShipment;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking\Data\Signature;
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
        $functionString           = 'd-get-piece';
        $expectedXmlRequestString = '<?xml version="1.0" encoding="UTF-8"?><data piece-code="' . $pieceCode . '" request="' . $functionString . '" appname="' . self::ZT_TOKEN . '" password="' . self::PASSWORD . '" language-code="' . $languageLocale . '"></data>';
        $xmlResponseStringMock    = '<?xml version="1.0" encoding="UTF-8"?><data name="piece-shipment-list" request-id="b2d27a0e-7c26-4d20-84dc-c94610b55a28" code="0"><data name="piece-shipment" error-status="0" piece-id="fc23a3ec-cca6-483e-8fd5-c927ab0e2b1c" shipment-code="" piece-identifier="340434161094042557" identifier-type="2" piece-code="00340434161094042557" event-location="" event-country="DE" status-liste="0" status-timestamp="18.03.2016 10:02" status="Die Sendung wurde erfolgreich zugestellt." short-status="Zustellung erfolgreich" recipient-name="Kraemer" recipient-street="Heinrich-Brüning-Str. 7" recipient-city="53113 Bonn" pan-recipient-name="Deutsche Post DHL" pan-recipient-street="Heinrich-Brüning-Str. 7" pan-recipient-city="53113 Bonn" pan-recipient-address="Heinrich-Brüning-Str. 7 53113 Bonn" pan-recipient-postalcode="53113" shipper-name="Es wurden keine Absender-Daten an DHL übermittelt." shipper-street="" shipper-city="" shipper-address="" product-code="00" product-key="" product-name="DHL PAKET" delivery-event-flag="1" recipient-id="5" recipient-id-text="andere anwesende Person" upu="" shipment-length="0.0" shipment-width="0.0" shipment-height="0.0" shipment-weight="0.0" international-flag="0" division="DPEED" ice="DLVRD" ric="OTHER" standard-event-code="ZU" dest-country="DE" origin-country="DE" searched-piece-code="00340434161094042557" searched-ref-no="" piece-customer-reference="" shipment-customer-reference="" leitcode="" routing-code-ean="" matchcode="" domestic-id="" airway-bill-number="" ruecksendung="false" pslz-nr="5066847896" order-preferred-delivery-day="false" /></data>';
        $client                   = $this->getClient($xmlResponseStringMock, $languageLocale);
        $requestObject            = new Request\Tracking\getPiece();
        $requestObject->pieceCode = $pieceCode;

        //when
        $response = $client->getPiece($requestObject);

        //then
        $this->commonAssertions($response, Request\Tracking\getPiece::class, $languageLocale, $expectedXmlRequestString, $xmlResponseStringMock,
            $functionString, 'b2d27a0e-7c26-4d20-84dc-c94610b55a28');
        $this->assertEquals($pieceCode, $response->request->pieceCode);

        $this->assertInstanceOf(PieceShipment::class, $response->pieceShipment);
        $this->assertEquals(0, $response->pieceShipment->errorStatus);
        $this->assertEquals(Null, $response->pieceShipment->pieceStatus);
        $this->assertEquals(Null, $response->pieceShipment->pieceStatusDesc);
        $this->assertEquals('fc23a3ec-cca6-483e-8fd5-c927ab0e2b1c', $response->pieceShipment->pieceId);
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

    public function testIntegrationGetSignature() {
        //given
        $pieceCode                = '00340434161094027318';
        $languageLocale           = 'de';
        $functionString           = 'd-get-signature';
        $imageHex                 = '474946383961de00de00f00000000000ffffff2c00000000de00de004008ff0003081c48b0a0c18308132a5cc8b0a1c38710234a9c48b1a2c58b18336adcc8b1a3c78f20438a1c49b2a4c9932853aa5cc9b2a5cb973063ca9c49b3a6cd9b3873eadcc9b3a7cf9f40830a1d4ab4a8d1a348932a5dcab469470001a03a9d6a532ad5ab31a15a95b915eb51a95dbd8a3569352c42b363d342ec8a9620d88300d0b655eb346cdbb203e73ad44b37e85db71ce3f2ed4b7430e1c3140d235eccb8b1e3c790234b9e4cb9b2e5cb98336bdeccb9b3e7cfa0438b1e4dbab4e9d3a853ab5ecdba35e7b8aec56a8ded5531eda1b3b3dabecdf02defa65b07c35ec8f6774abb0a7de7d538dcf845b970dd367f5876ae59c18ab16347bddbf9cfeede7b82ff0f4fbebcf9f3e8d3ab5fcfbebdfbf7f0e3cb9f4fbfbefdfbf8f3ebdfcfbfbfffff000628e080041668e0810826a8e0820c4e365e83114d072148b94d48e18316ee956148127285617815c2d4a17d216eb89172263227507629f606586f8609066171c445955c740ad278a38dd2d598207209a13862841fa277dd59cb45f5e188316a27238cdc21d96346284aa9247dd6add862845b3ed5a5975f9e18e698649669e69968a6a9e69a6cb6e9e69b70c629e79c74d669e79d78e6a9e79e7cf6e9e79f80062ae8a084166ae8a18826aae8a28c36eae8a390462ae9a494566ae9a59866aae9a69c76cadf9075824a678977926aa7a9a18a3a679166b25aa6ab63aab9da12acc6a13a2badb5f2e8617fb6aa84ab77bd9e242b96bae659e5a95aea796ca849baa8265e0d0d9b6270d1f2f5e4aff151eba2753a2ed82d92771dc9e0b738da95a5b706717b655ed68e9bee8ee44e341cb6bcc59ba4b616494b6c417f255b6c62efee276ec03c2e095d724fc22597be9b1dccef945cfa6be58a0c8318e48b544a7cd676f59dfbef9a7a25dc26bd5b923cad9f269fdc67ca26b2bca1cb19c2ece9cc34d76cf3cd38e7acf3ce3cf7ecf3cf40072d747a0101003b';
        $expectedXmlRequestString = '<?xml version="1.0" encoding="UTF-8"?><data piece-code="' . $pieceCode . '" date-from="2013-03-09" date-to="2013-03-10" request="' . $functionString . '" appname="' . self::ZT_TOKEN . '" password="' . self::PASSWORD . '" language-code="' . $languageLocale . '"></data>';
        $xmlResponseStringMock    = '<?xml version="1.0" encoding="UTF-8"?><data name="signature-list" code="0" request-id="15e7f3c8-cf7e-45b3-848f-613c26e96b14"><data name="signature" searched-piece-code="00340434161094027318" event-date="18.03.2016" mime-type="image/gif" image="' . $imageHex . '" /></data>';
        $client                   = $this->getClient($xmlResponseStringMock, $languageLocale);
        $requestObject            = new Request\Tracking\getSignature();
        $requestObject->pieceCode = $pieceCode;
        $requestObject->dateFrom  = '2013-03-09';
        $requestObject->dateTo    = '2013-03-10';

        //when
        $response = $client->getSignature($requestObject);

        //then
        $this->commonAssertions($response, Request\Tracking\getSignature::class, $languageLocale, $expectedXmlRequestString, $xmlResponseStringMock,
            $functionString, '15e7f3c8-cf7e-45b3-848f-613c26e96b14');
        $this->assertEquals($pieceCode, $response->request->pieceCode);
        $this->assertEquals('2013-03-09', $response->request->dateFrom);
        $this->assertEquals('2013-03-10', $response->request->dateTo);

        $this->assertInstanceOf(Signature::class, $response->signature);
        $this->assertEquals(hex2bin($imageHex), $response->signature->image);
        $this->assertEquals('18.03.2016', $response->signature->eventDate);
        $this->assertEquals('image/gif', $response->signature->mimeType);

    }

    public function testIntegrationGetStatusForPublicUser() {
        //given

        $languageLocale                = 'de';
        $functionString                = 'get-status-for-public-user';
        $expectedXmlRequestString      = '<?xml version="1.0" encoding="UTF-8"?><data from-date="2012-03-09" to-date="2012-03-10" request="' . $functionString . '" appname="' . self::ZT_TOKEN . '" password="' . self::PASSWORD . '" language-code="' . $languageLocale . '"><data piece-code="00340434161094027318" zip-code="53113" international-shipment="false"></data></data>';
        $xmlResponseStringMock         = '<?xml version="1.0" encoding="UTF-8"?><data request-id="15e7f3c8-cf7e-45b3-848f-613c26e96b14"><data name="piece-status-public-list" code="0" _piece-code="00340434161094027318" _zip-code=""><data name="piece-status-public" piece-identifier="00340434161094027318" _build-time="2012-06-06 18:18:10.000607" piece-id="3b048653-aaa9-485b-b0dd-d16e068230e9" leitcode="" pslz-nr="21975632975" order-preferred-delivery-day="false" searched-piece-code="00340434161094027318" piece-status="0" identifier-type="2" recipient-name="Hr. Hannes Testler" recipient-id="1" recipient-id-text="Empfänger (orig.)" pan-recipient-name=" " street-name="" house-number="" city-name="" last-event-timestamp="11.03.2012 11:59" shipment-type="" status-next="" status="Die Sendung wurde erfolgreich zugestellt." error-status="0" delivery-event-flag="1" upu="" international-flag="0" piece-code="00340434161094027318" matchcode="" domestic-id="" airway-bill-number="" ice="DLVRD" ric="OTHER" division="DPEED" dest-country="de" origin-country="de" product-code="09" product-name="Warenpost" searched-ref-no="034234" standard-event-code="ZU" pan-recipient-street="" pan-recipient-city="" event-country="de" event-location="" preferred-delivery-day="" preferred-delivery-timeframe-from="" preferred-delivery-timeframe-to="" preferred-timeframe-refused-text="" shipment-length="0.0" shipment-width="0.0" shipment-height="0.0" shipment-weight="1.0"><data name="piece-event" event-timestamp="23.12.2021 19:38" event-status="Die Sendung wurde elektronisch angekündigt. Sobald die Sendung von uns bearbeitet wurde, erhalten Sie weitere Informationen." event-text="Die Sendung wurde elektronisch angekündigt. Sobald die Sendung von uns bearbeitet wurde, erhalten Sie weitere Informationen." ice="PARCV" ric="NRQRD" event-location="" event-country="" standard-event-code="VA" ruecksendung="false"/><data name="piece-event" event-timestamp="24.12.2021 00:16" event-status="Die Sendung wird zum Weitertransport vorbereitet." event-text="Die Sendung wird zum Weitertransport vorbereitet." ice="SRTED" ric="NRQRD" event-location="Bonn" event-country="Deutschland" standard-event-code="NB" ruecksendung="false"/><data name="piece-event" event-timestamp="24.12.2021 07:23" event-status="Die Sendung wurde in das Zustellfahrzeug geladen. Die Zustellung erfolgt voraussichtlich heute." event-text="Die Sendung wurde in das Zustellfahrzeug geladen. Die Zustellung erfolgt voraussichtlich heute." ice="SRTED" ric="NRQRD" event-location="" event-country="" standard-event-code="PO" ruecksendung="false"/><data name="piece-event" event-timestamp="24.12.2021 09:32" event-status="Die Sendung wurde erfolgreich zugestellt." event-text="Die Sendung wurde erfolgreich zugestellt." ice="DLVRD" ric="OTHER" event-location="" event-country="Deutschland" standard-event-code="ZU" ruecksendung="false"/></data></data></data>';
        $client                        = $this->getClient($xmlResponseStringMock, $languageLocale, FALSE);
        $piece1                        = new PieceData();
        $piece1->pieceCode             = '00340434161094027318';
        $piece1->zipCode               = '53113';
        $piece1->internationalShipment = FALSE;
        $requestObject                 = new Request\Tracking\getStatusForPublicUser([$piece1]);
        $requestObject->fromDate       = '2012-03-09';
        $requestObject->toDate         = '2012-03-10';

        //when
        $response = $client->getStatusForPublicUser($requestObject);

        //then
        $this->commonAssertions($response, Request\Tracking\getStatusForPublicUser::class, $languageLocale, $expectedXmlRequestString, $xmlResponseStringMock,
            $functionString, '15e7f3c8-cf7e-45b3-848f-613c26e96b14');
        $this->assertEquals('2012-03-09', $response->request->fromDate);
        $this->assertEquals('2012-03-10', $response->request->toDate);

        $this->assertCount(1, $response->request->contentObjects);
        $this->assertEquals('00340434161094027318', $response->request->contentObjects[0]->pieceCode);
        $this->assertEquals('53113', $response->request->contentObjects[0]->zipCode);
        $this->assertTrue(FALSE === $response->request->contentObjects[0]->internationalShipment);

        $this->assertEquals('00340434161094027318', $response->_pieceCode);
        $this->assertEquals('', $response->_zipCode);

        $this->assertCount(1, $response->pieceStatusPublicList);
        $this->assertEquals('00340434161094027318', $response->pieceStatusPublicList[0]->pieceIdentifier);
        $this->assertEquals('00340434161094027318', $response->pieceStatusPublicList[0]->searchedPieceCode);
        $this->assertEquals('00340434161094027318', $response->pieceStatusPublicList[0]->pieceCode);
        $this->assertEquals('2012-06-06 18:18:10.000607', $response->pieceStatusPublicList[0]->_buildTime);
        $this->assertEquals('3b048653-aaa9-485b-b0dd-d16e068230e9', $response->pieceStatusPublicList[0]->pieceId);
        $this->assertTrue(FALSE === $response->pieceStatusPublicList[0]->orderPreferredDeliveryDay);
        $this->assertEquals('', $response->pieceStatusPublicList[0]->leitcode);
        $this->assertTrue(0 === $response->pieceStatusPublicList[0]->pieceStatus);
        $this->assertTrue(NULL === $response->pieceStatusPublicList[0]->pieceStatusDesc);
        $this->assertTrue(2 === $response->pieceStatusPublicList[0]->identifierType);
        $this->assertEquals('Hr. Hannes Testler', $response->pieceStatusPublicList[0]->recipientName);
        $this->assertTrue(1 === $response->pieceStatusPublicList[0]->recipientId);
        $this->assertEquals('Empfänger (orig.)', $response->pieceStatusPublicList[0]->recipientIdText);
        $this->assertEquals(' ', $response->pieceStatusPublicList[0]->panRecipientName);
        $this->assertEquals('', $response->pieceStatusPublicList[0]->panRecipientStreet);
        $this->assertEquals('', $response->pieceStatusPublicList[0]->panRecipientCity);
        $this->assertEquals('', $response->pieceStatusPublicList[0]->streetName);
        $this->assertEquals('', $response->pieceStatusPublicList[0]->houseNumber);
        $this->assertEquals('', $response->pieceStatusPublicList[0]->cityName);
        $this->assertEquals('11.03.2012 11:59', $response->pieceStatusPublicList[0]->lastEventTimestamp);
        $this->assertEquals('', $response->pieceStatusPublicList[0]->shipmentType);
        $this->assertEquals('', $response->pieceStatusPublicList[0]->statusNext);
        $this->assertEquals('Die Sendung wurde erfolgreich zugestellt.', $response->pieceStatusPublicList[0]->status);
        $this->assertTrue(0 === $response->pieceStatusPublicList[0]->errorStatus);
        $this->assertTrue(TRUE === $response->pieceStatusPublicList[0]->deliveryEventFlag);
        $this->assertEquals('', $response->pieceStatusPublicList[0]->upu);
        $this->assertTrue(FALSE === $response->pieceStatusPublicList[0]->internationalFlag);
        $this->assertEquals('', $response->pieceStatusPublicList[0]->matchcode);
        $this->assertEquals('', $response->pieceStatusPublicList[0]->domesticId);
        $this->assertEquals('', $response->pieceStatusPublicList[0]->airwayBillNumber);
        $this->assertEquals('DLVRD', $response->pieceStatusPublicList[0]->ice);
        $this->assertEquals('OTHER', $response->pieceStatusPublicList[0]->ric);
        $this->assertEquals('DPEED', $response->pieceStatusPublicList[0]->division);
        $this->assertEquals('de', $response->pieceStatusPublicList[0]->destCountry);
        $this->assertEquals('de', $response->pieceStatusPublicList[0]->originCountry);
        $this->assertEquals('09', $response->pieceStatusPublicList[0]->productCode);
        $this->assertEquals('Warenpost', $response->pieceStatusPublicList[0]->productName);
        $this->assertEquals('034234', $response->pieceStatusPublicList[0]->searchedRefNo);
        $this->assertEquals('ZU', $response->pieceStatusPublicList[0]->standardEventCode);
        $this->assertEquals('de', $response->pieceStatusPublicList[0]->eventCountry);
        $this->assertEquals('', $response->pieceStatusPublicList[0]->eventLocation);
        $this->assertEquals('', $response->pieceStatusPublicList[0]->preferredDeliveryDay);
        $this->assertEquals('', $response->pieceStatusPublicList[0]->preferredDeliveryTimeframeFrom);
        $this->assertEquals('', $response->pieceStatusPublicList[0]->preferredDeliveryTimeframeTo);
        $this->assertEquals('', $response->pieceStatusPublicList[0]->preferredDeliveryTimeframeRefusedText);
        $this->assertTrue(0.0 === $response->pieceStatusPublicList[0]->shipmentLength);
        $this->assertTrue(0.0 === $response->pieceStatusPublicList[0]->shipmentWidth);
        $this->assertTrue(0.0 === $response->pieceStatusPublicList[0]->shipmentHeight);
        $this->assertTrue(1.0 === $response->pieceStatusPublicList[0]->shipmentWeight);
        $this->assertTrue(TRUE === $response->pieceStatusPublicList[0]->hasNoErrors());

        $eventList = $response->pieceStatusPublicList[0]->pieceEventList;
        $this->assertCount(4, $eventList);

        $this->assertEquals('23.12.2021 19:38', $eventList[0]->eventTimestamp);
        $this->assertEquals('Die Sendung wurde elektronisch angekündigt. Sobald die Sendung von uns bearbeitet wurde, erhalten Sie weitere Informationen.', $eventList[0]->eventStatus);
        $this->assertNull($eventList[0]->eventShortStatus);
        $this->assertEquals('Die Sendung wurde elektronisch angekündigt. Sobald die Sendung von uns bearbeitet wurde, erhalten Sie weitere Informationen.', $eventList[0]->eventText);
        $this->assertEquals('PARCV', $eventList[0]->ice);
        $this->assertEquals('NRQRD', $eventList[0]->ric);
        $this->assertEquals('', $eventList[0]->eventLocation);
        $this->assertEquals('', $eventList[0]->eventCountry);
        $this->assertEquals('VA', $eventList[0]->standardEventCode);
        $this->assertTrue(FALSE === $eventList[0]->ruecksendung);

        $this->assertEquals('24.12.2021 00:16', $eventList[1]->eventTimestamp);
        $this->assertEquals('Die Sendung wird zum Weitertransport vorbereitet.', $eventList[1]->eventStatus);
        $this->assertNull($eventList[1]->eventShortStatus);
        $this->assertEquals('Die Sendung wird zum Weitertransport vorbereitet.', $eventList[1]->eventText);
        $this->assertEquals('SRTED', $eventList[1]->ice);
        $this->assertEquals('NRQRD', $eventList[1]->ric);
        $this->assertEquals('Bonn', $eventList[1]->eventLocation);
        $this->assertEquals('Deutschland', $eventList[1]->eventCountry);
        $this->assertEquals('NB', $eventList[1]->standardEventCode);
        $this->assertTrue(FALSE === $eventList[1]->ruecksendung);

        $this->assertEquals('24.12.2021 07:23', $eventList[2]->eventTimestamp);
        $this->assertEquals('Die Sendung wurde in das Zustellfahrzeug geladen. Die Zustellung erfolgt voraussichtlich heute.', $eventList[2]->eventStatus);
        $this->assertNull($eventList[2]->eventShortStatus);
        $this->assertEquals('Die Sendung wurde in das Zustellfahrzeug geladen. Die Zustellung erfolgt voraussichtlich heute.', $eventList[2]->eventText);
        $this->assertEquals('SRTED', $eventList[2]->ice);
        $this->assertEquals('NRQRD', $eventList[2]->ric);
        $this->assertEquals('', $eventList[2]->eventLocation);
        $this->assertEquals('', $eventList[2]->eventCountry);
        $this->assertEquals('PO', $eventList[2]->standardEventCode);
        $this->assertTrue(FALSE === $eventList[2]->ruecksendung);

        $this->assertEquals('24.12.2021 09:32', $eventList[3]->eventTimestamp);
        $this->assertEquals('Die Sendung wurde erfolgreich zugestellt.', $eventList[3]->eventStatus);
        $this->assertNull($eventList[3]->eventShortStatus);
        $this->assertEquals('Die Sendung wurde erfolgreich zugestellt.', $eventList[3]->eventText);
        $this->assertEquals('DLVRD', $eventList[3]->ice);
        $this->assertEquals('OTHER', $eventList[3]->ric);
        $this->assertEquals('', $eventList[3]->eventLocation);
        $this->assertEquals('Deutschland', $eventList[3]->eventCountry);
        $this->assertEquals('ZU', $eventList[3]->standardEventCode);
        $this->assertTrue(FALSE === $eventList[3]->ruecksendung);
    }

    public function testIntegrationGetPieceEvents() {
        //given
        $pieceId                  = 'bb37bebc-d9ec-42e2-a414-6f56bb3c6203';
        $languageLocale           = 'de';
        $functionString           = 'd-get-piece-events';
        $expectedXmlRequestString = '<?xml version="1.0" encoding="UTF-8"?><data piece-id="' . $pieceId . '" request="' . $functionString . '" appname="' . self::ZT_TOKEN . '" password="' . self::PASSWORD . '" language-code="' . $languageLocale . '"></data>';
        $xmlResponseStringMock    = '<?xml version="1.0" encoding="UTF-8"?><data name="piece-event-list" request-id="f9d60645-4f19-41dd-a3fd-9f3e79f31444" code="0" piece-identifier="340434161094032954" _build-time="2017-01-14 19:56:45.000486" piece-id="bb37bebc-d9ec-42e2-a414-6f56bb3c6203" leitcode="5311304400700" ruecksendung="false" pslz-nr="5066847829" order-preferred-delivery-day="false"><data name="piece-event" event-timestamp="17.03.2016 11:20" event-status="Die Sendung wurde vom Absender in die PACKSTATION eingeliefert." event-text="Die Sendung wurde vom Absender in die PACKSTATION eingeliefert." event-short-status="Einlieferung in PACKSTATION" ice="SHRCU" ric="PCKST" event-location="Bremen" event-country="Deutschland" standard-event-code="ES" ruecksendung="false" /><data name="piece-event" event-timestamp="17.03.2016 13:23" event-status="Die Sendung wurde zum Weitertransport aus der PACKSTATION entnommen." event-text="Die Sendung wurde zum Weitertransport aus der PACKSTATION entnommen." event-short-status="Transport zum Start-Paketzentrum" ice="LDTMV" ric="MVMTV" event-location="Bremen" event-country="Deutschland" standard-event-code="AA" ruecksendung="false" /><data name="piece-event" event-timestamp="17.03.2016 16:18" event-status="Die Sendung wurde abgeholt." event-text="Die Sendung wurde abgeholt." event-short-status="Abholung erfolgreich" ice="PCKDU" ric="PUBCR" event-location="" event-country="Deutschland" standard-event-code="AE" ruecksendung="false" /><data name="piece-event" event-timestamp="17.03.2016 18:12" event-status="Die Sendung wurde im Start-Paketzentrum bearbeitet." event-text="Die Sendung wurde im Start-Paketzentrum bearbeitet." event-short-status="Start-Paketzentrum" ice="LDTMV" ric="MVMTV" event-location="Bremen" event-country="Deutschland" standard-event-code="AA" ruecksendung="false" /><data name="piece-event" event-timestamp="18.03.2016 03:24" event-status="Die Sendung wurde im Ziel-Paketzentrum bearbeitet." event-text="Die Sendung wurde im Ziel-Paketzentrum bearbeitet." event-short-status="Ziel-Paketzentrum" ice="ULFMV" ric="UNLDD" event-location="Neuwied" event-country="Deutschland" standard-event-code="EE" ruecksendung="false" /><data name="piece-event" event-timestamp="18.03.2016 09:00" event-status="Die Sendung wurde in das Zustellfahrzeug geladen." event-text="Die Sendung wurde in das Zustellfahrzeug geladen." event-short-status="In Zustellung" ice="SRTED" ric="NRQRD" event-location="" event-country="" standard-event-code="PO" ruecksendung="false" /><data name="piece-event" event-timestamp="18.03.2016 10:02" event-status="Die Sendung wurde erfolgreich zugestellt." event-text="Die Sendung wurde erfolgreich zugestellt." event-short-status="Zustellung erfolgreich" ice="DLVRD" ric="OTHER" event-location="Bonn" event-country="Deutschland" standard-event-code="ZU" ruecksendung="false" /></data>';
        $client                   = $this->getClient($xmlResponseStringMock, $languageLocale);
        $requestObject            = new Request\Tracking\getPieceEvents();
        $requestObject->pieceId   = $pieceId;

        //when
        $response = $client->getPieceEvents($requestObject);

        //then
        $this->commonAssertions($response, Request\Tracking\getPieceEvents::class, $languageLocale, $expectedXmlRequestString, $xmlResponseStringMock,
            $functionString, 'f9d60645-4f19-41dd-a3fd-9f3e79f31444');
        $this->assertEquals($pieceId, $response->request->pieceId);

        $this->assertCount(7, $response->pieceEventList);

        $this->assertInstanceOf(PieceEvent::class, $response->pieceEventList[0]);
        $this->assertEquals('17.03.2016 11:20', $response->pieceEventList[0]->eventTimestamp);
        $this->assertEquals('Die Sendung wurde vom Absender in die PACKSTATION eingeliefert.', $response->pieceEventList[0]->eventStatus);
        $this->assertEquals('Die Sendung wurde vom Absender in die PACKSTATION eingeliefert.', $response->pieceEventList[0]->eventText);
        $this->assertEquals('Einlieferung in PACKSTATION', $response->pieceEventList[0]->eventShortStatus);
        $this->assertEquals('Bremen', $response->pieceEventList[0]->eventLocation);
        $this->assertEquals('Deutschland', $response->pieceEventList[0]->eventCountry);
        $this->assertEquals('ES', $response->pieceEventList[0]->standardEventCode);
        $this->assertEquals('SHRCU', $response->pieceEventList[0]->ice);
        $this->assertEquals('PCKST', $response->pieceEventList[0]->ric);
        $this->assertEquals(FALSE, $response->pieceEventList[0]->ruecksendung);

        $this->assertInstanceOf(PieceEvent::class, $response->pieceEventList[1]);
        $this->assertEquals('17.03.2016 13:23', $response->pieceEventList[1]->eventTimestamp);
        $this->assertEquals('Die Sendung wurde zum Weitertransport aus der PACKSTATION entnommen.', $response->pieceEventList[1]->eventStatus);
        $this->assertEquals('Die Sendung wurde zum Weitertransport aus der PACKSTATION entnommen.', $response->pieceEventList[1]->eventText);
        $this->assertEquals('Transport zum Start-Paketzentrum', $response->pieceEventList[1]->eventShortStatus);
        $this->assertEquals('Bremen', $response->pieceEventList[1]->eventLocation);
        $this->assertEquals('Deutschland', $response->pieceEventList[1]->eventCountry);
        $this->assertEquals('AA', $response->pieceEventList[1]->standardEventCode);
        $this->assertEquals('LDTMV', $response->pieceEventList[1]->ice);
        $this->assertEquals('MVMTV', $response->pieceEventList[1]->ric);
        $this->assertEquals(FALSE, $response->pieceEventList[1]->ruecksendung);

        $this->assertInstanceOf(PieceEvent::class, $response->pieceEventList[2]);
        $this->assertEquals('17.03.2016 16:18', $response->pieceEventList[2]->eventTimestamp);
        $this->assertEquals('Die Sendung wurde abgeholt.', $response->pieceEventList[2]->eventStatus);
        $this->assertEquals('Die Sendung wurde abgeholt.', $response->pieceEventList[2]->eventText);
        $this->assertEquals('Abholung erfolgreich', $response->pieceEventList[2]->eventShortStatus);
        $this->assertEquals('', $response->pieceEventList[2]->eventLocation);
        $this->assertEquals('Deutschland', $response->pieceEventList[2]->eventCountry);
        $this->assertEquals('AE', $response->pieceEventList[2]->standardEventCode);
        $this->assertEquals('PCKDU', $response->pieceEventList[2]->ice);
        $this->assertEquals('PUBCR', $response->pieceEventList[2]->ric);
        $this->assertEquals(FALSE, $response->pieceEventList[2]->ruecksendung);

        $this->assertInstanceOf(PieceEvent::class, $response->pieceEventList[3]);
        $this->assertEquals('17.03.2016 18:12', $response->pieceEventList[3]->eventTimestamp);
        $this->assertEquals('Die Sendung wurde im Start-Paketzentrum bearbeitet.', $response->pieceEventList[3]->eventStatus);
        $this->assertEquals('Die Sendung wurde im Start-Paketzentrum bearbeitet.', $response->pieceEventList[3]->eventText);
        $this->assertEquals('Start-Paketzentrum', $response->pieceEventList[3]->eventShortStatus);
        $this->assertEquals('Bremen', $response->pieceEventList[3]->eventLocation);
        $this->assertEquals('Deutschland', $response->pieceEventList[3]->eventCountry);
        $this->assertEquals('AA', $response->pieceEventList[3]->standardEventCode);
        $this->assertEquals('LDTMV', $response->pieceEventList[3]->ice);
        $this->assertEquals('MVMTV', $response->pieceEventList[3]->ric);
        $this->assertEquals(FALSE, $response->pieceEventList[3]->ruecksendung);

        $this->assertInstanceOf(PieceEvent::class, $response->pieceEventList[4]);
        $this->assertEquals('18.03.2016 03:24', $response->pieceEventList[4]->eventTimestamp);
        $this->assertEquals('Die Sendung wurde im Ziel-Paketzentrum bearbeitet.', $response->pieceEventList[4]->eventStatus);
        $this->assertEquals('Die Sendung wurde im Ziel-Paketzentrum bearbeitet.', $response->pieceEventList[4]->eventText);
        $this->assertEquals('Ziel-Paketzentrum', $response->pieceEventList[4]->eventShortStatus);
        $this->assertEquals('Neuwied', $response->pieceEventList[4]->eventLocation);
        $this->assertEquals('Deutschland', $response->pieceEventList[4]->eventCountry);
        $this->assertEquals('EE', $response->pieceEventList[4]->standardEventCode);
        $this->assertEquals('ULFMV', $response->pieceEventList[4]->ice);
        $this->assertEquals('UNLDD', $response->pieceEventList[4]->ric);
        $this->assertEquals(FALSE, $response->pieceEventList[4]->ruecksendung);

        $this->assertInstanceOf(PieceEvent::class, $response->pieceEventList[5]);
        $this->assertEquals('18.03.2016 09:00', $response->pieceEventList[5]->eventTimestamp);
        $this->assertEquals('Die Sendung wurde in das Zustellfahrzeug geladen.', $response->pieceEventList[5]->eventStatus);
        $this->assertEquals('Die Sendung wurde in das Zustellfahrzeug geladen.', $response->pieceEventList[5]->eventText);
        $this->assertEquals('In Zustellung', $response->pieceEventList[5]->eventShortStatus);
        $this->assertEquals('', $response->pieceEventList[5]->eventLocation);
        $this->assertEquals('', $response->pieceEventList[5]->eventCountry);
        $this->assertEquals('PO', $response->pieceEventList[5]->standardEventCode);
        $this->assertEquals('SRTED', $response->pieceEventList[5]->ice);
        $this->assertEquals('NRQRD', $response->pieceEventList[5]->ric);
        $this->assertEquals(FALSE, $response->pieceEventList[5]->ruecksendung);

        $this->assertInstanceOf(PieceEvent::class, $response->pieceEventList[6]);
        $this->assertEquals('18.03.2016 10:02', $response->pieceEventList[6]->eventTimestamp);
        $this->assertEquals('Die Sendung wurde erfolgreich zugestellt.', $response->pieceEventList[6]->eventStatus);
        $this->assertEquals('Die Sendung wurde erfolgreich zugestellt.', $response->pieceEventList[6]->eventText);
        $this->assertEquals('Zustellung erfolgreich', $response->pieceEventList[6]->eventShortStatus);
        $this->assertEquals('Bonn', $response->pieceEventList[6]->eventLocation);
        $this->assertEquals('Deutschland', $response->pieceEventList[6]->eventCountry);
        $this->assertEquals('ZU', $response->pieceEventList[6]->standardEventCode);
        $this->assertEquals('DLVRD', $response->pieceEventList[6]->ice);
        $this->assertEquals('OTHER', $response->pieceEventList[6]->ric);
        $this->assertEquals(FALSE, $response->pieceEventList[6]->ruecksendung);
    }

    public function testIntegrationGetPieceDetail() {
        //given
        $pieceCode                = '00340434161094042557';
        $languageLocale           = 'de';
        $functionString           = 'd-get-piece-detail';
        $expectedXmlRequestString = '<?xml version="1.0" encoding="UTF-8"?><data piece-code="' . $pieceCode . '" from-date="2016-01-01" to-date="2016-02-02" request="' . $functionString . '" appname="' . self::ZT_TOKEN . '" password="' . self::PASSWORD . '" language-code="' . $languageLocale . '"></data>';
        $xmlResponseStringMock    = '<?xml version="1.0" encoding="UTF-8"?><data name="piece-shipment-list" code="0" request-id="3c4fc963-9ba1-43db-1997-190530487dc1"><data name="piece-shipment" error-status="0" piece-id="fc23a3ec-cca6-483e-8fd5-c927ab0e2b1a" shipment-code="" piece-identifier="340434161094042557" identifier-type="2" piece-code="00340434161094042557" event-location="" event-country="DE" status-liste="0" status-timestamp="18.03.2016 10:02" status="Die Sendung wurde erfolgreich zugestellt." short-status="Zustellung erfolgreich" recipient-name="Kraemer" recipient-street="Heinrich-Brüning-Str. 7" recipient-city="53113 Bonn" pan-recipient-name="Deutsche Post DHL" pan-recipient-street="Heinrich-Brüning-Str. 7" pan-recipient-city="53113 Bonn" pan-recipient-address="Heinrich-Brüning-Str. 7 53113 Bonn" pan-recipient-postalcode="53113" shipper-name="Es wurden keine Absender-Daten an DHL übermittelt." shipper-street="" shipper-city="" shipper-address="" product-code="00" product-key="" product-name="DHL PAKET" delivery-event-flag="1" recipient-id="5" recipient-id-text="andere anwesende Person" upu="" shipment-length="0.0" shipment-width="0.0" shipment-height="0.0" shipment-weight="0.0" international-flag="0" division="DPEED" ice="DLVRD" ric="OTHER" standard-event-code="ZU" dest-country="DE" origin-country="DE" searched-piece-code="00340434161094042557" searched-ref-no="" piece-customer-reference="" shipment-customer-reference="" leitcode="" routing-code-ean="" matchcode="" domestic-id="" airway-bill-number="" ruecksendung="false" pslz-nr="5066847896" order-preferred-delivery-day="false"><data name="piece-event-list" piece-identifier="340434161094042557" _build-time="2017-01-14 19:56:43.000471" piece-id="fc23a3ec-cca6-483e-8fd5-c927ab0e2b1a" leitcode="5311304400700" routing-code-ean="" ruecksendung="false" pslz-nr="5066847896" order-preferred-delivery-day="false"><data name="piece-event" event-timestamp="17.03.2016 11:21" event-status="Die Sendung wurde vom Absender in die PACKSTATION eingeliefert." event-text="Die Sendung wurde vom Absender in die PACKSTATION eingeliefert." event-short-status="Einlieferung in PACKSTATION" ice="SHRCU" ric="PCKST" event-location="Bremen" event-country="Deutschland" standard-event-code="ES" ruecksendung="false" /><data name="piece-event" event-timestamp="17.03.2016 13:23" event-status="Die Sendung wurde zum Weitertransport aus der PACKSTATION entnommen." event-text="Die Sendung wurde zum Weitertransport aus der PACKSTATION entnommen." event-short-status="Transport zum Start-Paketzentrum" ice="LDTMV" ric="MVMTV" event-location="Bremen" event-country="Deutschland" standard-event-code="AA" ruecksendung="false" /><data name="piece-event" event-timestamp="17.03.2016 16:18" event-status="Die Sendung wurde abgeholt." event-text="Die Sendung wurde abgeholt." event-short-status="Abholung erfolgreich" ice="PCKDU" ric="PUBCR" event-location="" event-country="Deutschland" standard-event-code="AE" ruecksendung="false" /><data name="piece-event" event-timestamp="17.03.2016 18:12" event-status="Die Sendung wurde im Start-Paketzentrum bearbeitet." event-text="Die Sendung wurde im Start-Paketzentrum bearbeitet." event-short-status="Start-Paketzentrum" ice="LDTMV" ric="MVMTV" event-location="Bremen" event-country="Deutschland" standard-event-code="AA" ruecksendung="false" /><data name="piece-event" event-timestamp="18.03.2016 03:24" event-status="Die Sendung wurde im Ziel-Paketzentrum bearbeitet." event-text="Die Sendung wurde im Ziel-Paketzentrum bearbeitet." event-short-status="Ziel-Paketzentrum" ice="ULFMV" ric="UNLDD" event-location="Neuwied" event-country="Deutschland" standard-event-code="EE" ruecksendung="false" /><data name="piece-event" event-timestamp="18.03.2016 09:02" event-status="Die Sendung wurde in das Zustellfahrzeug geladen." event-text="Die Sendung wurde in das Zustellfahrzeug geladen." event-short-status="In Zustellung" ice="SRTED" ric="NRQRD" event-location="" event-country="" standard-event-code="PO" ruecksendung="false" /><data name="piece-event" event-timestamp="18.03.2016 10:02" event-status="Die Sendung wurde erfolgreich zugestellt." event-text="Die Sendung wurde erfolgreich zugestellt." event-short-status="Zustellung erfolgreich" ice="DLVRD" ric="OTHER" event-location="Bonn" event-country="Deutschland" standard-event-code="ZU" ruecksendung="false" /></data></data></data>';
        $client                   = $this->getClient($xmlResponseStringMock, $languageLocale);
        $requestObject            = new Request\Tracking\getPieceDetail();
        $requestObject->pieceCode = $pieceCode;
        $requestObject->fromDate  = '2016-01-01';
        $requestObject->toDate    = '2016-02-02';

        //when
        $response = $client->getPieceDetail($requestObject);

        //then
        $this->commonAssertions($response, Request\Tracking\getPieceDetail::class, $languageLocale, $expectedXmlRequestString, $xmlResponseStringMock,
            $functionString, '3c4fc963-9ba1-43db-1997-190530487dc1');
        $this->assertEquals($pieceCode, $response->request->pieceCode);
        $this->assertEquals('2016-01-01', $response->request->fromDate);
        $this->assertEquals('2016-02-02', $response->request->toDate);

        $this->assertInstanceOf(PieceShipment::class, $response->pieceShipment);
        $this->assertEquals(0, $response->pieceShipment->errorStatus);
        $this->assertEquals(Null, $response->pieceShipment->pieceStatus);
        $this->assertEquals(Null, $response->pieceShipment->pieceStatusDesc);
        $this->assertEquals('fc23a3ec-cca6-483e-8fd5-c927ab0e2b1a', $response->pieceShipment->pieceId);
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

        $this->assertCount(7, $response->pieceShipment->pieceEventList);

        $this->assertInstanceOf(PieceEvent::class, $response->pieceShipment->pieceEventList[0]);
        $this->assertEquals('17.03.2016 11:21', $response->pieceShipment->pieceEventList[0]->eventTimestamp);
        $this->assertEquals('Die Sendung wurde vom Absender in die PACKSTATION eingeliefert.', $response->pieceShipment->pieceEventList[0]->eventStatus);
        $this->assertEquals('Die Sendung wurde vom Absender in die PACKSTATION eingeliefert.', $response->pieceShipment->pieceEventList[0]->eventText);
        $this->assertEquals('Einlieferung in PACKSTATION', $response->pieceShipment->pieceEventList[0]->eventShortStatus);
        $this->assertEquals('Bremen', $response->pieceShipment->pieceEventList[0]->eventLocation);
        $this->assertEquals('Deutschland', $response->pieceShipment->pieceEventList[0]->eventCountry);
        $this->assertEquals('ES', $response->pieceShipment->pieceEventList[0]->standardEventCode);
        $this->assertEquals('SHRCU', $response->pieceShipment->pieceEventList[0]->ice);
        $this->assertEquals('PCKST', $response->pieceShipment->pieceEventList[0]->ric);
        $this->assertEquals(FALSE, $response->pieceShipment->pieceEventList[0]->ruecksendung);

        $this->assertInstanceOf(PieceEvent::class, $response->pieceShipment->pieceEventList[1]);
        $this->assertEquals('17.03.2016 13:23', $response->pieceShipment->pieceEventList[1]->eventTimestamp);
        $this->assertEquals('Die Sendung wurde zum Weitertransport aus der PACKSTATION entnommen.', $response->pieceShipment->pieceEventList[1]->eventStatus);
        $this->assertEquals('Die Sendung wurde zum Weitertransport aus der PACKSTATION entnommen.', $response->pieceShipment->pieceEventList[1]->eventText);
        $this->assertEquals('Transport zum Start-Paketzentrum', $response->pieceShipment->pieceEventList[1]->eventShortStatus);
        $this->assertEquals('Bremen', $response->pieceShipment->pieceEventList[1]->eventLocation);
        $this->assertEquals('Deutschland', $response->pieceShipment->pieceEventList[1]->eventCountry);
        $this->assertEquals('AA', $response->pieceShipment->pieceEventList[1]->standardEventCode);
        $this->assertEquals('LDTMV', $response->pieceShipment->pieceEventList[1]->ice);
        $this->assertEquals('MVMTV', $response->pieceShipment->pieceEventList[1]->ric);
        $this->assertEquals(FALSE, $response->pieceShipment->pieceEventList[1]->ruecksendung);

        $this->assertInstanceOf(PieceEvent::class, $response->pieceShipment->pieceEventList[2]);
        $this->assertEquals('17.03.2016 16:18', $response->pieceShipment->pieceEventList[2]->eventTimestamp);
        $this->assertEquals('Die Sendung wurde abgeholt.', $response->pieceShipment->pieceEventList[2]->eventStatus);
        $this->assertEquals('Die Sendung wurde abgeholt.', $response->pieceShipment->pieceEventList[2]->eventText);
        $this->assertEquals('Abholung erfolgreich', $response->pieceShipment->pieceEventList[2]->eventShortStatus);
        $this->assertEquals('', $response->pieceShipment->pieceEventList[2]->eventLocation);
        $this->assertEquals('Deutschland', $response->pieceShipment->pieceEventList[2]->eventCountry);
        $this->assertEquals('AE', $response->pieceShipment->pieceEventList[2]->standardEventCode);
        $this->assertEquals('PCKDU', $response->pieceShipment->pieceEventList[2]->ice);
        $this->assertEquals('PUBCR', $response->pieceShipment->pieceEventList[2]->ric);
        $this->assertEquals(FALSE, $response->pieceShipment->pieceEventList[2]->ruecksendung);

        $this->assertInstanceOf(PieceEvent::class, $response->pieceShipment->pieceEventList[3]);
        $this->assertEquals('17.03.2016 18:12', $response->pieceShipment->pieceEventList[3]->eventTimestamp);
        $this->assertEquals('Die Sendung wurde im Start-Paketzentrum bearbeitet.', $response->pieceShipment->pieceEventList[3]->eventStatus);
        $this->assertEquals('Die Sendung wurde im Start-Paketzentrum bearbeitet.', $response->pieceShipment->pieceEventList[3]->eventText);
        $this->assertEquals('Start-Paketzentrum', $response->pieceShipment->pieceEventList[3]->eventShortStatus);
        $this->assertEquals('Bremen', $response->pieceShipment->pieceEventList[3]->eventLocation);
        $this->assertEquals('Deutschland', $response->pieceShipment->pieceEventList[3]->eventCountry);
        $this->assertEquals('AA', $response->pieceShipment->pieceEventList[3]->standardEventCode);
        $this->assertEquals('LDTMV', $response->pieceShipment->pieceEventList[3]->ice);
        $this->assertEquals('MVMTV', $response->pieceShipment->pieceEventList[3]->ric);
        $this->assertEquals(FALSE, $response->pieceShipment->pieceEventList[3]->ruecksendung);

        $this->assertInstanceOf(PieceEvent::class, $response->pieceShipment->pieceEventList[4]);
        $this->assertEquals('18.03.2016 03:24', $response->pieceShipment->pieceEventList[4]->eventTimestamp);
        $this->assertEquals('Die Sendung wurde im Ziel-Paketzentrum bearbeitet.', $response->pieceShipment->pieceEventList[4]->eventStatus);
        $this->assertEquals('Die Sendung wurde im Ziel-Paketzentrum bearbeitet.', $response->pieceShipment->pieceEventList[4]->eventText);
        $this->assertEquals('Ziel-Paketzentrum', $response->pieceShipment->pieceEventList[4]->eventShortStatus);
        $this->assertEquals('Neuwied', $response->pieceShipment->pieceEventList[4]->eventLocation);
        $this->assertEquals('Deutschland', $response->pieceShipment->pieceEventList[4]->eventCountry);
        $this->assertEquals('EE', $response->pieceShipment->pieceEventList[4]->standardEventCode);
        $this->assertEquals('ULFMV', $response->pieceShipment->pieceEventList[4]->ice);
        $this->assertEquals('UNLDD', $response->pieceShipment->pieceEventList[4]->ric);
        $this->assertEquals(FALSE, $response->pieceShipment->pieceEventList[4]->ruecksendung);

        $this->assertInstanceOf(PieceEvent::class, $response->pieceShipment->pieceEventList[5]);
        $this->assertEquals('18.03.2016 09:02', $response->pieceShipment->pieceEventList[5]->eventTimestamp);
        $this->assertEquals('Die Sendung wurde in das Zustellfahrzeug geladen.', $response->pieceShipment->pieceEventList[5]->eventStatus);
        $this->assertEquals('Die Sendung wurde in das Zustellfahrzeug geladen.', $response->pieceShipment->pieceEventList[5]->eventText);
        $this->assertEquals('In Zustellung', $response->pieceShipment->pieceEventList[5]->eventShortStatus);
        $this->assertEquals('', $response->pieceShipment->pieceEventList[5]->eventLocation);
        $this->assertEquals('', $response->pieceShipment->pieceEventList[5]->eventCountry);
        $this->assertEquals('PO', $response->pieceShipment->pieceEventList[5]->standardEventCode);
        $this->assertEquals('SRTED', $response->pieceShipment->pieceEventList[5]->ice);
        $this->assertEquals('NRQRD', $response->pieceShipment->pieceEventList[5]->ric);
        $this->assertEquals(FALSE, $response->pieceShipment->pieceEventList[5]->ruecksendung);

        $this->assertInstanceOf(PieceEvent::class, $response->pieceShipment->pieceEventList[6]);
        $this->assertEquals('18.03.2016 10:02', $response->pieceShipment->pieceEventList[6]->eventTimestamp);
        $this->assertEquals('Die Sendung wurde erfolgreich zugestellt.', $response->pieceShipment->pieceEventList[6]->eventStatus);
        $this->assertEquals('Die Sendung wurde erfolgreich zugestellt.', $response->pieceShipment->pieceEventList[6]->eventText);
        $this->assertEquals('Zustellung erfolgreich', $response->pieceShipment->pieceEventList[6]->eventShortStatus);
        $this->assertEquals('Bonn', $response->pieceShipment->pieceEventList[6]->eventLocation);
        $this->assertEquals('Deutschland', $response->pieceShipment->pieceEventList[6]->eventCountry);
        $this->assertEquals('ZU', $response->pieceShipment->pieceEventList[6]->standardEventCode);
        $this->assertEquals('DLVRD', $response->pieceShipment->pieceEventList[6]->ice);
        $this->assertEquals('OTHER', $response->pieceShipment->pieceEventList[6]->ric);
        $this->assertEquals(FALSE, $response->pieceShipment->pieceEventList[6]->ruecksendung);
    }

    public function testIntegrationGetPieceDetailWithInvalidData() {
        //given
        $pieceCode                = '1337';
        $languageLocale           = 'de';
        $functionString           = 'd-get-piece-detail';
        $expectedXmlRequestString = '<?xml version="1.0" encoding="UTF-8"?><data piece-code="' . $pieceCode . '" from-date="2018-01-01" to-date="2018-02-02" request="' . $functionString . '" appname="' . self::ZT_TOKEN . '" password="' . self::PASSWORD . '" language-code="' . $languageLocale . '"></data>';
        $xmlResponseStringMock    = '<?xml version="1.0" encoding="UTF-8"?><data name="piece-shipment-list" code="100" request-id="a4ebfb97-5031-4d1e-837e-0a1822cbd23a"    error="Keine Daten gefunden.">    <data name="piece-shipment" searched-piece-code="1337"        piece-code="1337" international-flag="0" piece-status="100"        piece-status-desc="Keine Daten gefunden."/></data>';
        $client                   = $this->getClient($xmlResponseStringMock, $languageLocale);
        $requestObject            = new Request\Tracking\getPieceDetail();
        $requestObject->pieceCode = $pieceCode;
        $requestObject->fromDate  = '2018-01-01';
        $requestObject->toDate    = '2018-02-02';

        //when
        $response = $client->getPieceDetail($requestObject);

        //then
        $this->commonAssertions($response, Request\Tracking\getPieceDetail::class, $languageLocale, $expectedXmlRequestString, $xmlResponseStringMock,
            $functionString, 'a4ebfb97-5031-4d1e-837e-0a1822cbd23a', FALSE);
        $this->assertEquals(100, $response->code);
        $this->assertEquals($pieceCode, $response->request->pieceCode);
        $this->assertEquals('2018-01-01', $response->request->fromDate);
        $this->assertEquals('2018-02-02', $response->request->toDate);

        $this->assertInstanceOf(PieceShipment::class, $response->pieceShipment);
        $this->assertEquals(0, $response->pieceShipment->errorStatus);
        $this->assertEquals(100, $response->pieceShipment->pieceStatus);
        $this->assertEquals('Keine Daten gefunden.', $response->pieceShipment->pieceStatusDesc);
        $this->assertEquals(null, $response->pieceShipment->pieceId);
        $this->assertEquals('', $response->pieceShipment->shipmentCode);
        $this->assertEquals(null, $response->pieceShipment->pieceIdentifier);
        $this->assertEquals(null, $response->pieceShipment->identifierType);
        $this->assertEquals('1337', $response->pieceShipment->pieceCode);
        $this->assertEquals(null, $response->pieceShipment->eventLocation);
        $this->assertEquals(null, $response->pieceShipment->eventCountry);
        $this->assertEquals(null, $response->pieceShipment->statusListe);
        $this->assertEquals(null, $response->pieceShipment->statusTimestamp);
        $this->assertEquals(null, $response->pieceShipment->status);
        $this->assertEquals(null, $response->pieceShipment->shortStatus);
        $this->assertEquals(null, $response->pieceShipment->recipientName);
        $this->assertEquals(null, $response->pieceShipment->recipientStreet);
        $this->assertEquals(null, $response->pieceShipment->recipientCity);
        $this->assertEquals(null, $response->pieceShipment->panRecipientName);
        $this->assertEquals(null, $response->pieceShipment->panRecipientStreet);
        $this->assertEquals(null, $response->pieceShipment->panRecipientCity);
        $this->assertEquals(null, $response->pieceShipment->panRecipientAddress);
        $this->assertEquals(null, $response->pieceShipment->panRecipientPostalcode);
        $this->assertEquals(null, $response->pieceShipment->shipperName);
        $this->assertEquals(null, $response->pieceShipment->shipperStreet);
        $this->assertEquals(null, $response->pieceShipment->shipperCity);
        $this->assertEquals(null, $response->pieceShipment->shipperAddress);
        $this->assertEquals(null, $response->pieceShipment->productCode);
        $this->assertEquals(null, $response->pieceShipment->productKey);
        $this->assertEquals(null, $response->pieceShipment->productName);
        $this->assertEquals(null, $response->pieceShipment->deliveryEventFlag);
        $this->assertEquals(null, $response->pieceShipment->recipientId);
        $this->assertEquals(null, $response->pieceShipment->recipientIdText);
        $this->assertEquals(null, $response->pieceShipment->upu);
        $this->assertEquals(null, $response->pieceShipment->shipmentLength);
        $this->assertEquals(null, $response->pieceShipment->shipmentWidth);
        $this->assertEquals(null, $response->pieceShipment->shipmentHeight);
        $this->assertEquals(null, $response->pieceShipment->shipmentWeight);
        $this->assertEquals(null, $response->pieceShipment->internationalFlag);
        $this->assertEquals(null, $response->pieceShipment->division);
        $this->assertEquals(null, $response->pieceShipment->ice);
        $this->assertEquals(null, $response->pieceShipment->ric);
        $this->assertEquals(null, $response->pieceShipment->standardEventCode);
        $this->assertEquals(null, $response->pieceShipment->destCountry);
        $this->assertEquals(null, $response->pieceShipment->originCountry);
        $this->assertEquals('1337', $response->pieceShipment->searchedPieceCode);
        $this->assertEquals(null, $response->pieceShipment->searchedRefNr);
        $this->assertEquals(null, $response->pieceShipment->pieceCustomerReference);
        $this->assertEquals(null, $response->pieceShipment->shipmentCustomerReference);
        $this->assertEquals(null, $response->pieceShipment->leitcode);
        $this->assertEquals(null, $response->pieceShipment->routingCodeEan);
        $this->assertEquals(null, $response->pieceShipment->matchcode);
        $this->assertEquals(null, $response->pieceShipment->domesticId);
        $this->assertEquals(null, $response->pieceShipment->airwayBillNumber);
        $this->assertEquals(null, $response->pieceShipment->ruecksendung);
        $this->assertEquals(null, $response->pieceShipment->pslzNr);
        $this->assertEquals(null, $response->pieceShipment->orderPreferredDeliveryDay);

        $this->assertCount(0, $response->pieceShipment->pieceEventList);
    }

    /**
     * @param string $expectedXmlResponseString
     * @param string $languageLocale
     * @param bool $isSandbox
     *
     * @return TrackingClient
     */
    private function getClient($expectedXmlResponseString, $languageLocale = 'DE', $isSandbox = TRUE) {
        $restMock = $this->getMockBuilder(Rest::class)
            ->setConstructorArgs([self::APP_ID, self::API_TOKEN, $isSandbox])
            ->setMethods(['callRestFunction'])
            ->getMock();
        $restMock->method('callRestFunction')
            ->willReturn($expectedXmlResponseString);


        $credentials = new TrackingClientCredentials(self::APP_ID, self::API_TOKEN, self::ZT_TOKEN, self::PASSWORD);

        return new TrackingClient($credentials, $isSandbox, $languageLocale, $restMock);
    }

    /**
     * @param AbstractTrackingResponse $response
     * @param string $requestClass
     * @param string $languageLocale
     * @param string $expectedXmlRequestString
     * @param string $xmlResponseStringMock
     * @param string $functionString
     * @param string $requestId
     *
     * @return void
     */
    private function commonAssertions(AbstractTrackingResponse $response, $requestClass, $languageLocale, $expectedXmlRequestString, $xmlResponseStringMock, $functionString, $requestId, $expectedHasNoErrors = TRUE) {
        $this->assertInstanceOf(Version::class, $response->Version);
        $this->assertEquals(TrackingClient::MAJOR_RELEASE, $response->Version->majorRelease);
        $this->assertEquals(TrackingClient::MINOR_RELEASE, $response->Version->minorRelease);

        $this->assertInstanceOf($requestClass, $response->request);
        $this->assertEquals($functionString, $response->request->request);
        $this->assertEquals(self::ZT_TOKEN, $response->request->appname);
        $this->assertEquals(self::PASSWORD, $response->request->password);
        $this->assertEquals($languageLocale, $response->request->languageCode);

        $this->assertEquals($requestId, $response->requestId);
        $this->assertEquals($expectedXmlRequestString, $response->rawRequest);
        $this->assertEquals(simplexml_load_string($xmlResponseStringMock), $response->rawResponse);

        if($expectedHasNoErrors) {
            $this->assertTrue(0 === $response->code);
        }
        $this->assertTrue($expectedHasNoErrors === $response->hasNoErrors());
    }

}