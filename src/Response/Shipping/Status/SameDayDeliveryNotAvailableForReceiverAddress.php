<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;


/**
 * Class SameDayDeliveryNotAvailableForReceiverAddress
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class SameDayDeliveryNotAvailableForReceiverAddress extends HardValidationError {

    protected $messageEnglish = 'The usage of the product "DHL Paket Taggleich" (same day delivery) is not available for the given receiver address.';

    protected $messageGerman  = 'Die Benutzung des Produktes DHL Paket Taggleich ist für diese Empfängeradresse nicht möglich.';

}