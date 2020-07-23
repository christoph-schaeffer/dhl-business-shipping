<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ShipmentDetails\Service;

use ChristophSchaeffer\Dhl\BusinessShipping\Resource\AbstractService;

/**
 * Class CashOnDelivery
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ShipmentDetails\Service
 *
 * Service Cash on delivery
 */
class CashOnDelivery extends AbstractService {

    /**
     * @var boolean
     *
     * Configuration whether the transmission fee to be added to the COD amount or not by DHL. Select the option then
     * the new COD amount will automatically printed on the shipping label and will transferred to the end of the day
     * to DHL. Do not select the option and the specified COD amount remains unchanged.
     */
    public $addFee;

    /**
     * @var float
     *
     * Min value: 0.01
     * Max value: 3500.0 (this may change over time)
     *
     * Money amount to be collected. Mandatory if COD is chosen.
     * Attention: Please add the additional 2 EURO transmittal fee when entering the COD Amount
     */
    public $codAmount;

}