<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking\Data;

use ChristophSchaeffer\Dhl\BusinessShipping\Utility\XmlParser;

/**
 * Class PieceStatusPublic
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking\Data
 */
class PieceStatusPublic
{
    public $pieceIdentifier;
    public $_buildTime;
    public $pieceId;
    public $leitcode;
    public $searchedPieceCode;
    public $pieceStatus;
    public $identifierType;
    public $recipientName;
    public $recipientId;
    public $recipientIdText;
    public $panRecipientName;
    public $streetName;
    public $houseNumber;
    public $cityName;
    public $lastEventTimestamp;
    public $shipmentType;
    public $statusNext;
    public $status;
    public $errorStatus;
    public $deliveryEventFlag;
    public $upu;
    public $internationalFlag;
    public $pieceCode;
    public $ice;
    public $ric;
    public $division;
    public $destCountry;
    public $originCountry;
    public $productCode;
    public $productName;
    public $searchedRefNo;
    public $standardEventCode;
    public $panRecipientStreet;
    public $panRecipientCity;
    public $eventCountry;
    public $eventLocation;
    public $shipmentLength;
    public $shipmentWidth;
    public $shipmentHeight;
    public $shipmentWeight;

    public function __construct(\SimpleXMLElement $rawXmlStatusForPublicData) {
        XmlParser::mapXmlAttributesToObjectProperties($rawXmlStatusForPublicData, $this);
    }
}
