<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class ProductNotAvailableForShipperCountry
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class ProductNotAvailableForShipperCountry extends HardValidationError {

    protected $messageEnglish = 'The product is not available for the country of origin.';

    protected $messageGerman  = 'Das Produkt ist nicht für das Absenderland verfügbar.';

}