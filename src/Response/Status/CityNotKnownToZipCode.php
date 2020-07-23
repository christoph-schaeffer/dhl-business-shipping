<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class CityNotKnownToZipCode
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class CityNotKnownToZipCode extends WeakValidationError {

    protected $messageEnglish = 'The city is not known to this postcode.';

    protected $messageGerman  = 'Der Ort ist zu dieser PLZ nicht bekannt.';

}