<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class RoutingCodeNotPossible
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class RoutingCodeNotPossible extends WeakValidationError {

    protected $messageEnglish = 'The shipment is not routing codable.';

    protected $messageGerman  = 'Die Sendung ist nicht leitcodierbar.';

}