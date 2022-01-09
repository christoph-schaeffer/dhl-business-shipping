<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

/**
 * Class ZipCodeNotFound
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class ZipCodeNotFound extends WeakValidationError {

    protected $messageEnglish = 'The postal code could not be found.';

    protected $messageGerman  = 'Die Postleitzahl konnte nicht gefunden werden.';

}