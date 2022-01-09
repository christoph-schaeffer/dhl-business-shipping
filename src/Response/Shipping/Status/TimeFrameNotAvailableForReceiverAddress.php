<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

/**
 * Class TimeFrameNotAvailableForReceiverAddress
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class TimeFrameNotAvailableForReceiverAddress extends HardValidationError {

    protected $messageEnglish = 'The time frame you have specified is not available for the given receiver address.';

    protected $messageGerman  = 'Das von Ihnen ausgewählte Zustellzeitfenster steht leider für diese Empfängeradresse nicht zur Verfügung.';

}