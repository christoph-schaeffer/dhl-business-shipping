<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

/**
 * Class SystemOverload
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class SystemOverload extends QoSFailure {

    public    $code           = 21;

    protected $messageEnglish = 'The system is currently unavailable due to overload.';

    protected $messageGerman  = 'Das System ist wegen Überlastung zur zeit nicht erreichbar.';

    public    $text           = 'System overload';

}