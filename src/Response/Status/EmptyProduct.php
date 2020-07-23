<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class EmptyProduct
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class EmptyProduct extends HardValidationError {

    protected $messageEnglish = 'Please enter a product.';

    protected $messageGerman  = 'Bitte geben Sie ein Produkt an.';

}