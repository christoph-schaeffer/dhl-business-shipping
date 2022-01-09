<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

/**
 * Class EmptyExportPositionDescription
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class EmptyExportPositionDescription extends HardValidationError {

    protected $messageEnglish = 'Please enter a description.';

    protected $messageGerman  = 'Bitte geben Sie die Beschreibung an.';

}