<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder;

/**
 * Class PrintOnlyIfCodeable
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder
 *
 * If active is set to TRUE, the label will only be printable, if the receiver address is valid.
 */
class PrintOnlyIfCodeable {

    /**
     * @var bool
     *
     * Indicates, if the option is on/off
     */
    public $active = FALSE;
}