<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking\Data;

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
}
