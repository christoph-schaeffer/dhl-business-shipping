<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;


/**
 * Class CodAmountToHigh
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class CodAmountToHigh extends HardValidationError {

    protected $messageEnglish = 'The entered cash on delivery amount is to high.';

    protected $messageGerman  = 'Der angegebene Nachnahmebetrag zu hoch.';

}