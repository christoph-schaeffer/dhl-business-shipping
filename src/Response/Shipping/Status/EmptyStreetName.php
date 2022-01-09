<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;


/**
 * Class EmptyStreetName
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class EmptyStreetName extends HardValidationError {

    protected $messageEnglish = 'Please enter a street.';

    protected $messageGerman  = 'Bitte geben Sie eine Straße an.';

}