<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class NetworkIOReadFailure
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class NetworkIOReadFailure extends NetworkFailure {

    public    $code           = 182;

    protected $messageEnglish = 'Error reading request (server) or response (client)';

    protected $messageGerman  = 'Fehler beim Lesen des Requests (Server) oder Responses (Client)';

    public    $text           = 'Network IO read failure';

}