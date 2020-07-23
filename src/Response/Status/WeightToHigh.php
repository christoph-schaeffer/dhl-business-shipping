<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class WeightToHigh
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class WeightToHigh extends HardValidationError {

    protected $messageEnglish = 'The weight you have entered is to high.';

    protected $messageGerman  = 'Die Gewichtsangabe ist zu hoch.';

}