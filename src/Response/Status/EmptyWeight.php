<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class EmptyWeight
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class EmptyWeight extends HardValidationError {

    protected $messageEnglish = 'Please enter a weight.';

    protected $messageGerman  = 'Bitte geben Sie ein Gewicht an.';

}