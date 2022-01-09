<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

/**
 * Class WeightToLow
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class WeightToLow extends HardValidationError {

    protected $messageEnglish = 'The weight you have entered is to low.';

    protected $messageGerman  = 'Die Gewichtsangabe ist zu gering.';

}