<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

/**
 * Class InvalidZipCode
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class InvalidZipCode extends HardValidationError {

    protected $messageEnglish = 'Invalid postal code specified.';

    protected $messageGerman  = 'Es handelt sich um eine ungültige Postleitzahl.';

}