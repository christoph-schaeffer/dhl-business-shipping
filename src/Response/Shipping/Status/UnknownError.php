<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

/**
 * Class UnknownError
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class UnknownError extends AbstractStatus {

    public    $code           = 9999;

    protected $messageEnglish = 'An unknown error has occurred';

    protected $messageGerman  = 'Ein Unbekannter Fehler ist aufgetreten';

    public    $text           = 'Unknown error occurred';

}