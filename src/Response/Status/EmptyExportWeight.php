<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class EmptyExportWeight
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class EmptyExportWeight extends HardValidationError {

    protected $messageEnglish = 'Please enter the weight.';

    protected $messageGerman  = 'Bitte geben Sie das Gewicht an.';

}