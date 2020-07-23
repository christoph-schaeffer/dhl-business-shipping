<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class GeneralError
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class GeneralError extends AbstractStatus {

    public    $code           = 1000;

    protected $messageEnglish = 'A general error has occurred. Please contact your system administrator.';

    protected $messageGerman  = 'Ein allgemeiner Fehler ist aufgetreten. Bitte wenden Sie sich an Ihren Systemadministrator.';

    public    $text           = 'General Error';

}