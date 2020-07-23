<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class UnknownProduct
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class UnknownProduct extends HardValidationError {

    protected $messageEnglish = 'The specified product is unknown.';

    protected $messageGerman  = 'Das angegebene Produkt ist nicht bekannt.';

}