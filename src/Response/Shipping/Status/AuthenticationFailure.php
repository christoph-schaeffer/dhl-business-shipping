<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

/**
 * Class AuthenticationFailure
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class AuthenticationFailure extends AbstractStatus {

    public    $code           = 1001;

    protected $messageEnglish = 'The user of the web service could not be authenticated.';

    protected $messageGerman  = 'Der Nutzer des Webservice konnte nicht authentifiziert werden.';

    public    $text           = 'Authentication Failure';

}