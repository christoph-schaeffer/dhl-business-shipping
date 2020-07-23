<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class InvalidExportType
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class InvalidExportType extends HardValidationError {

    protected $messageEnglish = 'The specified type of shipment is not valid.';

    protected $messageGerman  = 'Die angegebene Art der Sendung ist nicht gültig.';

}