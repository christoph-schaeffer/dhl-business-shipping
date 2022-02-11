<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking\Data;

use ChristophSchaeffer\Dhl\BusinessShipping\Utility\XmlParser;

/**
 * Class PieceShipment
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking\Data
 */
class PieceShipment
{
    public $errorStatus;
    public $pieceId;
    public $shipmentCode;
    public $pieceIdentifier;
    public $eventLocation;
    public $eventCountry;
    public $statusListe;
    public $statusTimestamp;
    public $status;
    public $shortStatus;
    public $recipientName;
    public $recipientStreet;
    public $recipientCity;
    public $panRecipientName;
    public $panRecipientStreet;
    public $panRecipientCity;
    public $panRecipientAddress;
    public $shipperName;
    public $shipperStreet;
    public $shipperCity;
    public $shipperAddress;
    public $productCode;
    public $productKey;
    public $productName;
    public $deliveryEventFlag;
    public $recipientId;
    public $recipientIdText;
    public $upu;
    public $shipmentLength;
    public $shipmentWidth;
    public $shipmentHeight;
    public $shipmentWeight;
    public $internationalFlag;
    public $division;
    public $ice;
    public $ric;
    public $standardEventCode;
    public $destCountry;
    public $originCountry;
    public $searchedPieceCode;
    public $searchedRefNr;
    public $pieceCustomerReference;
    public $shipmentCustomerReference;
    public $leitcode;

    /** @var PieceEvent[] */
    public $pieceEventList = [];

    /**
     * @param \SimpleXMLElement $rawShipmentData
     */
    public function __construct(\SimpleXMLElement $rawShipmentData) {
        XmlParser::mapXmlAttributesToObjectProperties($rawShipmentData, $this);
        if(isset($rawShipmentData->data) && isset($rawShipmentData->data->data)) {
            $rawEventList = $rawShipmentData->data->data;
            foreach($rawEventList as $rawEvent) {
                $this->pieceEventList[] = new PieceEvent($rawEvent);
            }
        }
    }
}
