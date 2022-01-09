<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

/**
 * Class LengthToLong
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class LengthToLong extends HardValidationError {

    protected $messageEnglish = 'The entered length is to long.';

    protected $messageGerman  = 'Die angegebene Länge ist zu groß.';

}