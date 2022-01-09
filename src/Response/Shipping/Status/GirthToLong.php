<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

/**
 * Class GirthToLong
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class GirthToLong extends HardValidationError {

    protected $messageEnglish = 'The entered girth is to long.';

    protected $messageGerman  = 'Das angegebene Gurtmaß ist zu groß.';

}