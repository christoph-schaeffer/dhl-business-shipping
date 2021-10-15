<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class InvalidCustomsTariffNumber
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class InvalidCustomsTariffNumber extends HardValidationError
{

    protected $messageEnglish = 'The customs tariff number must be numeric and 6, 8 or 10 digits long. Please note that the customs tariff number of the receiving country must be entered, not the German customs tariff number.';

    protected $messageGerman = 'Die Zolltarifnummer muss numerisch und 6, 8 oder 10 Stellen lang sein. Bitte beachten Sie, dass die Zolltarifnummer des Empfangslandes, nicht die deutsche Zolltarifnummer eingetragen werden muss.';

}
