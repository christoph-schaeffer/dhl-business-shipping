<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class HardValidationError
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class HardValidationError extends AbstractStatus {

    public    $code           = 1101;

    protected $messageEnglish = 'A Hard validation error has occured.';

    protected $messageGerman  = 'Es ist ein schwerwiegender Fehler aufgetreten.';

    public    $text           = 'Hard validation error occured.';

}