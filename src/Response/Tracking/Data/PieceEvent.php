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
     * A status message for the current event in the language that has been defined.
     */
    public $eventStatus;
    /**
     * @var string
     *
     * An event text in the language that has been defined. This is mostly identical to eventStatus
     */
    public $eventText;
    /**
     * @var string
     *
     * A shorter status message for the current event in the language that has been defined.
     */
    public $eventShortStatus;
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
    /**
     * @var bool
     *
     * Defines if it is a return shipment
     */
    public $ruecksendung;

    public function __construct(\SimpleXMLElement $rawXmlEventData) {
        XmlParser::mapXmlAttributesToObjectProperties($rawXmlEventData, $this);
        $this->convertPropertyTo('bool', 'ruecksendung');
    }

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
