<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class NetworkIOWriteFailure
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class NetworkIOWriteFailure extends NetworkFailure {

    public    $code           = 183;

    protected $messageEnglish = 'Error writing request (server) or response (client)';

    protected $messageGerman  = 'Fehler beim schreiben des Requests (Server) oder Responses (Client)';

    public    $text           = 'Network IO write failure';

}