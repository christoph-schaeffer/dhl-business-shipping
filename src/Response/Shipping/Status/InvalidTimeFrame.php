<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

/**
 * Class InvalidTimeFrame
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class InvalidTimeFrame extends HardValidationError {

    protected $messageEnglish = 'The given time frame is not valid';

    protected $messageGerman  = 'Das gewählte Zeitfenster ist nicht gültig.';

}