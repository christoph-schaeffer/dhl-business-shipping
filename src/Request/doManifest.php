<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Request;

/**
 * Class doManifest
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Request
 *
 * With this operation a end-of-day closing for up to 30 previously created shipments can be carried out. Please
 * keep in mind, that once you have called this function for a shipment order it can't be canceled anymore.
 */
class doManifest extends AbstractRequest {

    /**
     * @var string[]
     *
     * Min length: 1(per entry)
     * Max length: 39(per entry)
     *
     * Can contain any DHL shipment number or multiple shipment numbers
     */
    public $shipmentNumber;

    /**
     * @param string[] $shipmentNumbers
     *
     * doManifest constructor.
     */
    public function __construct(array $shipmentNumbers) {
        parent::__construct();
        $this->shipmentNumber = $shipmentNumbers;
    }

}