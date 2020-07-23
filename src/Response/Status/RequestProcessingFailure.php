<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class RequestProcessingFailure
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class RequestProcessingFailure extends AbstractStatus {

    public    $code           = 10;

    protected $messageEnglish = 'An unknown internal error occurred while processing the XML request / response.';

    protected $messageGerman  = 'Es ist ein unbekannter interner Fehler beim Verarbeiten des XML-Requests/Responses aufgetreten.';

    public    $text           = 'Request processing failure';

}