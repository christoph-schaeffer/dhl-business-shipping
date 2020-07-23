<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class EmptyExportType
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class EmptyExportType extends HardValidationError {

    protected $messageEnglish = 'Please specify the type of shipment.';

    protected $messageGerman  = 'Bitte geben Sie die Art der Sendung an.';

}