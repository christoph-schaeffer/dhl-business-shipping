<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class ProductNotAvailableForReceiverCountry
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class ProductNotAvailableForReceiverCountry extends HardValidationError {

    protected $messageEnglish = 'The specified product is not available for the country.';

    protected $messageGerman  = 'Das angegebene Produkt ist für das Land nicht verfügbar.';

}