<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

/**
 * Class EmptyCustomsValue
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class EmptyCustomsValue extends HardValidationError {

    protected $messageEnglish = 'Please enter a customs value.';

    protected $messageGerman  = 'Bitte geben Sie den Warenwert an.';

}