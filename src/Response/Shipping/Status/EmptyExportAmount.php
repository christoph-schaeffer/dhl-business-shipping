<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

/**
 * Class EmptyExportAmount
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class EmptyExportAmount extends HardValidationError {

    protected $messageEnglish = 'Please specify an amount.';

    protected $messageGerman  = 'Bitte geben Sie die Anzahl an.';

}