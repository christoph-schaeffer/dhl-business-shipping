<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;


/**
 * Class InvalidDate
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class InvalidMinimumAge extends HardValidationError {

    protected $messageEnglish = 'The entered minimum age is invalid.';

    protected $messageGerman  = 'Mindestalter hat einen falschen Wert';

}