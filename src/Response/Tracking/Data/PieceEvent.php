<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking\Data;

use ChristophSchaeffer\Dhl\BusinessShipping\Utility\XmlParser;

/**
 * Class PieceEvent
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking\Data
 */
class PieceEvent
{
    /**
     * @var string
     *
     * Time stamp for the current status in the format DD.MM.YYYY SS:MM
     */
    public $eventTimestamp;
    /**
     * @var string
     *
     * A Status message for the current event in the language that has been defined.
     */
    public $eventStatus;
    /**
     * @var string
     *
     * An event text in the language that has been defined. This can be longer than the event status, but is mostly identical
     */
    public $eventText;
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
     * Location at which the shipment event was created
     */
    public $eventLocation;
    /**
     * @var string
     *
     * Country in which the shipment event was created
     */
    public $eventCountry;
    /**
     * @var string
     *
     * Default code for the shipment event. For details check the attachment at the bottom of the following page
     * (you need to be authenticated on entwickler.dhl.de)
     * https://entwickler.dhl.de/group/ep/wsapis/sendungsverfolgung/track-trace/entwicklung-und-test/version-3.0/io-referenz/xml-schnittstelle
     */
    public $standardEventCode;

    public function __construct(\SimpleXMLElement $rawXmlEventData) {
        XmlParser::mapXmlAttributesToObjectProperties($rawXmlEventData, $this);
    }
}
