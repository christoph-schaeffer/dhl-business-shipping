<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

/**
 * Class AuthorizationFailure
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class AuthorizationFailure extends GeneralFailure {

    public    $code           = 110;

    protected $messageEnglish = 'An authorization error has occurred.';

    protected $messageGerman  = 'Es ist ein Authorisierungsfehler aufgetreten.';

    public    $text           = 'Authorization failure';

}