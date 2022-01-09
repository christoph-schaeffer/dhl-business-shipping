<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

/**
 * Class WidthToLarge
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class WidthToLarge extends HardValidationError {

    protected $messageEnglish = 'The entered width is to large.';

    protected $messageGerman  = 'Die angegebene Breite ist zu groß.';

}