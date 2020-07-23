<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class DayOfDeliverInThePast
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class DayOfDeliveryInThePast extends HardValidationError {

    protected $messageEnglish = 'The delivery date must be at least today.';

    protected $messageGerman  = 'Das Zustelldatum muss mindestens heute sein.';

}