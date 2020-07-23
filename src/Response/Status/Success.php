<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class Success
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class Success extends AbstractStatus {

    public    $code           = 0;

    protected $messageEnglish = 'The web service has been executed without any errors.';

    protected $messageGerman  = 'Der Webservice wurde ohne Fehler ausgeführt.';

    public    $text           = 'ok';

}