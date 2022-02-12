<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking\Data;

use ChristophSchaeffer\Dhl\BusinessShipping\Utility\XmlParser;

/**
 * Class PieceShipment
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking\Data
 */
class PieceShipment {
    /**
     * @var int
     *
     * Error status for the current request
     *
     * For more information check the following url (you need to be authenticated on entwickler.dhl.de)
     * https://entwickler.dhl.de/group/ep/wsapis/sendungsverfolgung/allgemeinefehlerhandhabung
     *
     * 0 = successful
     */
    public $errorStatus;
    /**
     * @var string
     *
     * Unique piece id. not to be confused with the tracking number ("Sendungsnummer"). This is not the tracking number.
     * A piece id looks like this: 3b048653-aaa9-485b-b0dd-d16e068230e9
     */
    public $pieceId;
    /**
     * @var string
     *
     * Shipment number
     */
    public $shipmentCode;
    /**
     * @var string
     *
     * An identifier of the piece. identifierType defines the type of it (tracking number, ref nr, etc)
     */
    public $pieceIdentifier;
    /**
     * @var int
     *
     * defines the type of pieceIdentifier (tracking number, ref nr, etc). It uses an undocumented enum (int)
     */
    public $identifierType;
    /**
     * @var string
     *
     * Location at which the shipment event was created
     */
    public $eventLocation;
    /**
     * @var string
     *
     * Country at which the shipment event was created
     */
    public $eventCountry;
    /**
     * @var string
     *
     * Not documented by DHL and seems to be always "0"...
     */
    public $statusListe;
    /**
     * @var string
     *
     * Time stamp for the current status in the format DD.MM.YYYY SS:MM
     */
    public $statusTimestamp;
    /**
     * @var string
     *
     * Status of an individual piece in the defined language
     */
    public $status;
    /**
     * @var string
     *
     * A short status of an individual piece in the defined language
     */
    public $shortStatus;
    /**
     * @var string
     *
     * Recipient full name (IST)
     */
    public $recipientName;
    /**
     * @var string
     *
     * Recipient street and house number
     */
    public $recipientStreet;
    /**
     * @var string
     *
     * 	Recipient zip code and city name seperated by a space. E.g. "53113 Bonn"
     */
    public $recipientCity;
    /**
     * @var string
     *
     * PAN Recipient name. This is not documented by DHL. it is unclear why this exists.
     */
    public $panRecipientName;
    /**
     * @var string
     *
     * PAN Recipient street and house number. This is not documented by DHL. it is unclear why this exists.
     */
    public $panRecipientStreet;
    /**
     * @var string
     *
     * PAN Recipient city with zip code seperated by a space. E.g. "53113 Bonn". This is not documented by DHL. it is unclear why this exists.
     */
    public $panRecipientCity;
    /**
     * @var string
     *
     * PAN Recipient full address in one line. This is not documented by DHL. it is unclear why this exists.
     */
    public $panRecipientAddress;
    /**
     * @var string
     *
     * The full name of the shipper
     */
    public $shipperName;
    /**
     * @var string
     *
     * Street name and house number of the shipper
     */
    public $shipperStreet;
    /**
     * @var string
     *
     * zip code and city name seperated by a space. E.g. "53113 Bonn"
     */
    public $shipperCity;
    /**
     * @var string
     *
     * The shippers full address in one line.
     */
    public $shipperAddress;
    /**
     * @var string
     *
     * The product key of the shipment. E.g. "V01PAK" for national shipments (DHL Paket)
     */
    public $productCode;
    /**
     * @var string
     *
     * Seems to be a dead property after they renamed it to productCode. This is always empty and undocumented by DHL
     */
    public $productKey;
    /**
     * @var string
     *
     * Product name (e.g. DHL Paket)
     */
    public $productName;
    /**
     * @var bool
     *
     * Returns true as the result if the shipment has been delivered. If the shipment is still being delivered, the value
     * is returned as false. The attribute can be used to ensure successful delivery before signatures (PODs) are retrieved.
     */
    public $deliveryEventFlag;
    /**
     * @var string
     *
     * Id of the recipient type, however these ids are not documented by DHL.
     *
     * 2 = Spouse
     * 5 = Other present person
     */
    public $recipientId;
    /**
     * @var string
     *
     * Delivers a text resolution in the event of successful delivery. E.g. "Ehegatte" / "Spouse"
     */
    public $recipientIdText;
    /**
     * @var string
     *
     * UPU / Matchcode for foreign shipments
     */
    public $upu;
    /**
     * @var float
     *
     * The shipments length
     */
    public $shipmentLength;
    /**
     * @var float
     *
     * The shipments width
     */
    public $shipmentWidth;
    /**
     * @var float
     *
     * The shipments height
     */
    public $shipmentHeight;
    /**
     * @var float
     *
     * The shipments weight in kg
     */
    public $shipmentWeight;
    /**
     * @var bool
     *
     * Designates a shipment that has been sent to / from abroad
     */
    public $internationalFlag;
    /**
     * @var string
     *
     * Designates the internal production line. For details check the attachment at the bottom of the following page
     * (you need to be authenticated on entwickler.dhl.de)
     * https://entwickler.dhl.de/group/ep/wsapis/sendungsverfolgung/track-trace/entwicklung-und-test/version-3.0/io-referenz/xml-schnittstelle
     */
    public $division;
    /**
     * @var string
     *
     * "International Coded Event". For details check the attachment at the bottom of the following page
     * (you need to be authenticated on entwickler.dhl.de)
     * https://entwickler.dhl.de/group/ep/wsapis/sendungsverfolgung/track-trace/entwicklung-und-test/version-3.0/io-referenz/xml-schnittstelle
     */
    public $ice;
    /**
     * @var string
     *
     * "Reason Instruction Code". For details check the attachment at the bottom of the following page
     * (you need to be authenticated on entwickler.dhl.de)
     * https://entwickler.dhl.de/group/ep/wsapis/sendungsverfolgung/track-trace/entwicklung-und-test/version-3.0/io-referenz/xml-schnittstelle
     */
    public $ric;
    /**
     * @var string
     *
     * Default code for the shipment event. For details check the attachment at the bottom of the following page
     * (you need to be authenticated on entwickler.dhl.de)
     * https://entwickler.dhl.de/group/ep/wsapis/sendungsverfolgung/track-trace/entwicklung-und-test/version-3.0/io-referenz/xml-schnittstelle
     */
    public $standardEventCode;
    /**
     * @var string
     *
     * ISO code for the shipment's destination country (e.g. DE for Germany)
     */
    public $destCountry;
    /**
     * @var string
     *
     * ISO code for the shipment's country of origin (e.g. DE for Germany)
     */
    public $originCountry;
    /**
     * @var string
     *
     * Shipment number that was searched for
     */
    public $searchedPieceCode;
    /**
     * @var string
     *
     * Customer reference that was searched for
     */
    public $searchedRefNr;
    /**
     * @var string
     *
     * Customer reference that the shipment has
     */
    public $pieceCustomerReference;
    /**
     * @var string
     *
     * Customer reference that was searched for
     */
    public $shipmentCustomerReference;
    /**
     * @var string
     *
     * Direction code of the shipment - no longer available!
     */
    public $leitcode;
    /**
     * @var string
     */
    public $routingCodeEan;
    /**
     * @var string
     */
    public $matchcode;
    /**
     * @var string
     */
    public $domesticId;
    /**
     * @var string
     */
    public $airwayBillNumber;
    /**
     * @var bool
     *
     * Defines if it is a return shipment
     */
    public $ruecksendung;
    /**
     * @var string
     */
    public $pslzNr;
    /**
     * @var bool
     *
     * Defines if the order has been made with a preferred day setting
     */
    public $orderPreferredDeliveryDay;

    /** @var PieceEvent[] */
    public $pieceEventList = [];

    /**
     * @param \SimpleXMLElement $rawShipmentData
     */
    public function __construct(\SimpleXMLElement $rawShipmentData) {
        XmlParser::mapXmlAttributesToObjectProperties($rawShipmentData, $this);
        if(isset($rawShipmentData->data) && isset($rawShipmentData->data->data)):
            $rawEventList = $rawShipmentData->data->data;
            foreach($rawEventList as $rawEvent):
                $this->pieceEventList[] = new PieceEvent($rawEvent);
            endforeach;
        endif;

        $this->convertPropertyTo('int', 'errorStatus');
        $this->convertPropertyTo('int', 'identifierType');
        $this->convertPropertyTo('bool', 'deliveryEventFlag');
        $this->convertPropertyTo('bool', 'internationalFlag');
        $this->convertPropertyTo('bool', 'ruecksendung');
        $this->convertPropertyTo('bool', 'orderPreferredDeliveryDay');
        $this->convertPropertyTo('float', 'shipmentLength');
        $this->convertPropertyTo('float', 'shipmentWidth');
        $this->convertPropertyTo('float', 'shipmentHeight');
        $this->convertPropertyTo('float', 'shipmentWeight');
    }

    /**
     * @param string $type
     * @param string $propertyName
     */
    private function convertPropertyTo($type, $propertyName) {
        if($this->{$propertyName} === '' || $this->{$propertyName} === null) {
            return;
        }

        switch($type) {
            case 'int':
                $this->{$propertyName} = (int)$this->{$propertyName};
                break;
            case 'float':
                $this->{$propertyName} = (float)$this->{$propertyName};
                break;
            case 'bool':
                $this->{$propertyName} = $this->{$propertyName} === '1' || strtolower($this->{$propertyName}) === 'true';
                break;
        }
    }
}
