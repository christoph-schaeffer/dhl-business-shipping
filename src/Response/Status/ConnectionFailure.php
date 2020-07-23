<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class ConnectionFailure
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class ConnectionFailure extends NetworkFailure {

    public    $code           = 181;

    protected $messageEnglish = 'The connection establishment already failed at the network level';

    protected $messageGerman  = 'Der Verbindungsaufbau scheiterte bereits auf Netzwerkebene';

    public    $text           = 'Connection failure';

}