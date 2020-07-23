<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class EmptyPostNumber
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class EmptyPostNumber extends HardValidationError {

    protected $messageEnglish = 'Please enter a post number.';

    protected $messageGerman  = 'Bitte geben Sie eine Postnummer an.';

}