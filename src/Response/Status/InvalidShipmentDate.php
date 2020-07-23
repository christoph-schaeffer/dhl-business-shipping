<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;


/**
 * Class InvalidShipmentDate
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class InvalidShipmentDate extends HardValidationError {

    protected $messageEnglish = 'Please enter a valid shipment date.';

    protected $messageGerman  = 'Bitte geben Sie ein gültiges Sendungsdatum an.';

}