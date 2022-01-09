<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

/**
 * Class NoEndorsementOnInternationalShipping
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class NoEndorsementOnInternationalShipping extends HardValidationError {

    protected $messageEnglish = 'Please note that the endorsement service is mandatory for shipments with DHL Paket International.';

    protected $messageGerman  = 'Bitte beachten Sie, dass der Service Vorausverfügung für Sendungen mit DHL Paket International verpflichtend ist.';

}
