<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class StreetNumberNotFound
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class StreetNumberNotFound extends WeakValidationError {

    protected $messageEnglish = 'The specified house number can not be found.';

    protected $messageGerman  = 'Die angegebene Hausnummer kann nicht gefunden werden.';

}