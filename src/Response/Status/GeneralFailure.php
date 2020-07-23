<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class GeneralFailure
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class GeneralFailure extends AbstractStatus {

    public    $code           = 100;

    protected $messageEnglish = 'A general failure has occurred.';

    protected $messageGerman  = 'Es ist ein allgemeiner Fehler aufgetreten.';

    public    $text           = 'General Failure';

}