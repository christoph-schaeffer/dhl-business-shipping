<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class EmptyCity
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class EmptyCity extends HardValidationError {

    protected $messageEnglish = 'Please enter a city.';

    protected $messageGerman  = 'Bitte geben Sie einen Ort an.';

}