<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder;

/**
 * Class Shipment
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder
 *
 * Is the core element of a ShipmentOrder. It contains all relevant information of the shipment.
 */
class Shipment {

    /**
     * @var Shipment\ExportDocument
     *
     * Optional
     *
     * For international shipments, this section contains information about the exported goods relevant for customs.
     * For international shipments: commercial invoice, dispatch note (CP71) and customs declaration (CN23) are printed
     * into returned label information. Data is also transferred as electronic declaration to customs. For european
     * shipments. For international shipments, ExportDocument can contain one or more positions in child element.
     */
    public $ExportDocument;

    /**
     * @var Shipment\Receiver
     *
     * Contains relevant information about the Receiver.
     */
    public $Receiver;

    /**
     * @var Shipment\ReturnReceiver
     *
     * Optional
     *
     * To be used if a return label address shall be generated. If it is NULL, no return label will be printed.
     */
    public $ReturnReceiver;

    /**
     * @var Shipment\ShipmentDetails
     *
     * Contains the information of the shipment product code, weight and size characteristics and services to be used.
     */
    public $ShipmentDetails;

    /**
     * @var Shipment\Shipper
     *
     * Contains relevant information about the Shipper.
     */
    public $Shipper;

    /**
     * Shipment constructor.
     */
    public function __construct() {
        $this->ShipmentDetails = new Shipment\ShipmentDetails();
        $this->Shipper         = new Shipment\Shipper();
        $this->Receiver        = new Shipment\Receiver();
        $this->ReturnReceiver  = new Shipment\ReturnReceiver();
        $this->ExportDocument  = new Shipment\ExportDocument();
    }
}