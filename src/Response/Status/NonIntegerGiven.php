<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class NonIntegerGiven
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class NonIntegerGiven extends HardValidationError {

    protected $messageEnglish = 'Please enter an integer.';

    protected $messageGerman  = 'Bitte geben Sie eine ganze Zahl ein.';

}