<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class EmptyPreferredTime
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class EmptyPreferredTime extends HardValidationError {

    protected $messageEnglish = 'Please specify a time frame.';

    protected $messageGerman  = 'Bitte wählen Sie ein Zeitfenster.';

}