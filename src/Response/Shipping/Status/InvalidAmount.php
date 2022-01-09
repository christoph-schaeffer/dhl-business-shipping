<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

/**
 * Class InvalidAmount
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class InvalidAmount extends HardValidationError {

    protected $messageEnglish = 'Please enter a valid amount.';

    protected $messageGerman  = 'Bitte geben Sie einen gültigen Betrag an.';

}