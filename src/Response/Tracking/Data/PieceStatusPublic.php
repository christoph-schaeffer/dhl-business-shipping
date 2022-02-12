<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking\Data;

use ChristophSchaeffer\Dhl\BusinessShipping\Utility\XmlParser;

/**
 * Class PieceStatusPublic
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking\Data
 */
class PieceStatusPublic {
    /**
     * @var string
     *
     * An identifier of the piece. identifierType defines the type of it (tracking number, ref nr, etc)
     */
    public $pieceIdentifier;
    /**
     * @var string
     *
     * date time format: YYYY-MM-DD HH:ii:ss.uuuuuu
     */
    public $_buildTime;
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
     * Direction code of the shipment - no longer available!
     */
    public $leitcode;
    /**
     * @var string
     *
     * Shipment number that was searched for
     */
    public $searchedPieceCode;
    /**
     * @var string
     *
     * Status of an individual piece in the defined language
     */
    public $pieceStatus;
    /**
     * @var int
     *
     * defines the type of pieceIdentifier (tracking number, ref nr, etc). It uses an undocumented enum (int)
     */
    public $identifierType;
    /**
     * @var string
     *
     * Recipient full name (IST)
     */
    public $recipientName;
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
     * PAN Recipient name. This is not documented by DHL. it is unclear why this exists.
     */
    public $panRecipientName;
    /**
     * @var string
     *
     * Recipient street
     */
    public $streetName;
    /**
     * @var string
     *
     * Recipient house number
     */
    public $houseNumber;
    /**
     * @var string
     *
     * Recipient city name
     */
    public $cityName;
    /**
     * @var string
     *
     * Time stamp for the last event status in the format DD.MM.YYYY SS:MM
     */
    public $lastEventTimestamp;
    /**
     * @var string
     */
    public $shipmentType;
    /**
     * @var string
     */
    public $statusNext;
    /**
     * @var string
     *
     * Status of the request in the defined language
     */
    public $status;
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
     * @var bool
     *
     * Returns true as the result if the shipment has been delivered. If the shipment is still being delivered, the value
     * is returned as false. The attribute can be used to ensure successful delivery before signatures (PODs) are retrieved.
     */
    public $deliveryEventFlag;
    /**
     * @var string
     *
     * UPU / Matchcode for foreign shipments
     */
    public $upu;
    /**
     * @var bool
     *
     * Designates a shipment that has been sent to / from abroad
     */
    public $internationalFlag;
    /**
     * @var string
     *
     * Shipment number that was searched for
     */
    public $pieceCode;
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
     * Designates the internal production line. For details check the attachment at the bottom of the following page
     * (you need to be authenticated on entwickler.dhl.de)
     * https://entwickler.dhl.de/group/ep/wsapis/sendungsverfolgung/track-trace/entwicklung-und-test/version-3.0/io-referenz/xml-schnittstelle
     */
    public $division;
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
     * The product key of the shipment. E.g. "V01PAK" for national shipments (DHL Paket)
     */
    public $productCode;
    /**
     * @var string
     *
     * Product name (e.g. DHL Paket)
     */
    public $productName;
    /**
     * @var string
     *
     * Customer reference that was searched for
     */
    public $searchedRefNo;
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
     * Country at which the shipment event was created
     */
    public $eventCountry;
    /**
     * @var string
     *
     * Location at which the shipment event was created
     */
    public $eventLocation;
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
     * @param \SimpleXMLElement $rawXmlStatusForPublicData
     */
    public function __construct(\SimpleXMLElement $rawXmlStatusForPublicData) {
        XmlParser::mapXmlAttributesToObjectProperties($rawXmlStatusForPublicData, $this);

        $this->convertPropertyTo('int', 'errorStatus');
        $this->convertPropertyTo('int', 'identifierType');
        $this->convertPropertyTo('bool', 'deliveryEventFlag');
        $this->convertPropertyTo('bool', 'internationalFlag');
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
