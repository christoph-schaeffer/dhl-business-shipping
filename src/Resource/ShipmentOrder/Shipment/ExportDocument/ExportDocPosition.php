<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ExportDocument;

/**
 * Class ExportDocPosition
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ExportDocument
 *
 * One or more child elements for every position to be defined within the Export Document. Each one contains
 * description, country code of origin, amount, net weight, customs value. Multiple positions only possible for
 * international shipments, other than EU shipments.
 */
class ExportDocPosition {

    /**
     * @var int
     *
     * Min value: 1
     * Max value: infinity
     *
     * Quantity of the unit / position
     */
    public $amount;

    /**
     * @var string
     *
     * Min length: 2
     * Max length: 2
     *
     * Country's ISO-Code (ISO-2- Alpha) of the unit / position
     * e.g. DE, FR, ES
     */
    public $countryCodeOrigin;

    /**
     * @var string
     *
     * Min length: 0
     * Max length: 10
     *
     * Customs tariff number of the unit / position.
     */
    public $customsTariffNumber;

    /**
     * @var float
     *
     * Min value: 0.01
     * Max value: infinity
     *
     * customs value amount of the unit / position
     */
    public $customsValue;

    /**
     * @var string
     *
     * Min length: 0
     * Max length: 256
     *
     * Description of the unit / position
     */
    public $description;

    /**
     * @var float
     *
     * Min value: 0.0
     * Max value: infinity
     *
     * Net weight of the unit / position.
     */
    public $netWeightInKG = 0;
}