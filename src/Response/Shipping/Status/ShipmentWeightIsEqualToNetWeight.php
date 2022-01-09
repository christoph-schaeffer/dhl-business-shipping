<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

/**
 * Class ShipmentWeightIsEqualToNetWeight
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class ShipmentWeightIsEqualToNetWeight extends HardValidationError {

    protected $messageEnglish = 'The shipment weight is equal to the net weight of the given export positions. Please enter the total weight including packaging and fillings.';

    protected $messageGerman  = 'Das Sendungsgewicht entspricht dem Gesamtnettogewicht der Warenpositionen. Bitte tragen Sie hier das Gesamtgewicht der Sendung einschließlich Verpackungs- und Füllmaterialien ein.';

}
