<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

/**
 * Class NoShipmentsForManifestFound
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class NoShipmentsForManifestFound extends RequestProcessingFailure {

    public    $code           = 2000;

    protected $messageEnglish = 'There are no shipments for the selected account number and day.';

    protected $messageGerman  = 'Es sind keine Sendungen für die gewählte Abrechnungsnummer und den Tag.';

    public    $text           = 'No shipments for manifest found';

}