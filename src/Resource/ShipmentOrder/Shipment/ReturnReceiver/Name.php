<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ReturnReceiver;

use \ChristophSchaeffer\Dhl\BusinessShipping\Resource;

/**
 * Class Name
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ReturnReceiver
 *
 * Name of the address that is printed on the return label. Note that this is an additional object instead of being
 * in the address object as it is with the (non return) receiver. This is only used when printing a return label.
 */
class Name extends Resource\AbstractName {

}