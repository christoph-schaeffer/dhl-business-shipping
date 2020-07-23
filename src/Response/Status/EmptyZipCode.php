<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class EmptyZipCode
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class EmptyZipCode extends HardValidationError {

    protected $messageEnglish = 'Please enter a postal code.';

    protected $messageGerman  = 'Bitte geben Sie eine Postleitzahl an.';

}