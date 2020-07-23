<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class EmptyDayOfDelivery
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class EmptyDayOfDelivery extends HardValidationError {

    protected $messageEnglish = 'Please specify the day of delivery.';

    protected $messageGerman  = 'Bitte wählen Sie ein Datum.';

}