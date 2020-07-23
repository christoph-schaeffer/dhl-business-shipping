<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class WeakValidationError
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class WeakValidationError extends AbstractStatus {

    public    $code           = 0;

    protected $messageEnglish = 'A weak validation error has occured.';

    protected $messageGerman  = 'Es ist ein leichter Fehler aufgetreten.';

    public    $text           = 'Weak validation error occured.';

}