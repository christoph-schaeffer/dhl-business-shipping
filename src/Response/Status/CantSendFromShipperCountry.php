<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class CantSendFromShipperCountry
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class CantSendFromShipperCountry extends HardValidationError {

    protected $messageEnglish = 'You can not send from that sender country.';

    protected $messageGerman  = 'Sie können aus dem Absenderland nicht verschicken.';

}