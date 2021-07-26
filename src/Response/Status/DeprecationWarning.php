<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class DeprecationWarning
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class DeprecationWarning extends WeakValidationError {

    protected $messageEnglish = 'A value you specified is no longer supported. Please check your input.';

    protected $messageGerman  = 'Ein von Ihnen angegebener Wert wird nicht mehr unterstützt. Bitte prüfen Sie Ihre Eingabe.';

}
