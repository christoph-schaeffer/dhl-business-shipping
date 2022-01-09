<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;


/**
 * Class InvalidIBAN
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class InvalidIBAN extends HardValidationError {

    protected $messageEnglish = 'The entered IBAN is invalid.';

    protected $messageGerman  = 'Die angegebene IBAN ist nicht gültig.';

}