<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

/**
 * Class EmptyExportTypeDescription
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class EmptyExportTypeDescription extends HardValidationError {

    protected $messageEnglish = 'Please specify a description of the export type you have chosen.';

    protected $messageGerman  = 'Bitte geben Sie eine Beschreibung für die von Ihnen angegebene Export Art an.';

}