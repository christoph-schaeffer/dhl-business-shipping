<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

/**
 * Class HardValidationError
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class UnknownShipmentNumber extends AbstractStatus {

    public    $code           = 2000;

    protected $messageEnglish = 'Could not find the specified shipment number.';

    protected $messageGerman  = 'Die angegebene Sendungsnummer konnte nicht gefunden werden.';

    public    $text           = 'Unknown shipment number.';

}