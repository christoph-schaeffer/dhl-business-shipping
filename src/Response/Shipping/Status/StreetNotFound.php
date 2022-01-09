<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

/**
 * Class StreetNotFound
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class StreetNotFound extends WeakValidationError {

    protected $messageEnglish = 'The specified street can not be found.';

    protected $messageGerman  = 'Die angegebene Straße kann nicht gefunden werden.';

}