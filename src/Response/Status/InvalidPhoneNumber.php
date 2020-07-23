<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class InvalidPhoneNumber
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class InvalidPhoneNumber extends HardValidationError {

    protected $messageEnglish = 'Please enter a valid phone number.';

    protected $messageGerman  = 'Bitte geben Sie eine gültige Telefonnummer an.';

}