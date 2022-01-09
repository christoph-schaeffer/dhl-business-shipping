<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

/**
 * Class QoSFailure
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class QoSFailure extends AbstractStatus {

    public    $code           = 20;

    protected $messageEnglish = 'Quality of service is not sufficient.';

    protected $messageGerman  = 'Quality of Service nicht ausreichend.';

    public    $text           = 'QoS failure';

}