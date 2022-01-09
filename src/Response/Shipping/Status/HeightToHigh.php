<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

/**
 * Class HeightToHigh
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class HeightToHigh extends HardValidationError {

    protected $messageEnglish = 'The entered height is to high.';

    protected $messageGerman  = 'Die angegebene Höhe ist zu groß.';

}