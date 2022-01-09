<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

/**
 * Class ZPL2LabelFormatAutomaticallyChanged
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class ZPL2LabelFormatAutomaticallyChanged extends WeakValidationError {

    protected $messageEnglish = 'The ZPL2 format was automatically changed to 103 x 199 mm.';

    protected $messageGerman  = 'Das ZPL2-Format wurde automatisch auf 103 x 199 mm geändert.';

}