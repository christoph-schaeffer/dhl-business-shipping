<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;


/**
 * Class EmptyStreetNumber
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class EmptyStreetNumber extends HardValidationError {

    protected $messageEnglish = 'Please enter a house number.';

    protected $messageGerman  = 'Bitte geben Sie eine Hausnummer an.';

}