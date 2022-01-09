<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

/**
 * Class InvalidPostNumber
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class InvalidPostNumber extends HardValidationError {

    protected $messageEnglish = 'The post number used is not valid. Please enter a valid post number.';

    protected $messageGerman  = 'Die verwendete Postnummer ist nicht gültig. Bitte geben Sie eine gültige Postnummer an.';

}