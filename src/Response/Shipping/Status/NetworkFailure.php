<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

/**
 * Class NetworkFailure
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class NetworkFailure extends GeneralFailure {

    public    $code           = 180;

    protected $messageEnglish = 'Network errors in the context of web service processing.';

    protected $messageGerman  = 'Netzwerkfehler im Kontext der Webservice Verarbeitung.';

    public    $text           = 'Network failure';

}