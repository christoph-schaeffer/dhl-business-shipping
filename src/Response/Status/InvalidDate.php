<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;


/**
 * Class InvalidDate
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class InvalidDate extends HardValidationError {

    protected $messageEnglish = 'Please enter a valid date.';

    protected $messageGerman  = 'Bitte geben Sie ein gültiges Datum an.';

}