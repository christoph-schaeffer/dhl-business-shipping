<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking\Data;

use ChristophSchaeffer\Dhl\BusinessShipping\Utility\XmlParser;

/**
 * Class PieceEvent
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking\Data
 */
class PieceEvent
{
    public $eventTimestamp;
    public $eventStatus;
    public $eventText;
    public $ice;
    public $ric;
    public $eventLocation;
    public $eventCountry;
    public $standardEventCode;

    public function __construct(\SimpleXMLElement $rawXmlEventData) {
        XmlParser::mapXmlAttributesToObjectProperties($rawXmlEventData, $this);
    }
}
