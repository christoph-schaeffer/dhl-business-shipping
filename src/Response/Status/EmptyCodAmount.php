<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class EmptyCodAmount
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class EmptyCodAmount extends HardValidationError {

    protected $messageEnglish = 'Please enter a cash on delivery amount.';

    protected $messageGerman  = 'Bitte geben Sie einen Nachnahmebetrag an.';

}