<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ShipmentDetails\Service;

use ChristophSchaeffer\Dhl\BusinessShipping\Resource\AbstractService;

/**
 * Class PreferredTime
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ShipmentDetails\Service
 *
 * Preferred Time of delivery for product:
 * V01PAK: DHL PAKET
 * V06PAK: DHL PAKET TAGGLEICH
 */
class PreferredTime extends AbstractService {

    /**
     * 10:00 until 12:00
     */
    const TIME_FRAME_10_12 = '10001200';

    /**
     * 12:00 until 14:00
     */
    const TIME_FRAME_12_14 = '12001400';

    /**
     * 14:00 until 16:00
     */
    const TIME_FRAME_14_16 = '14001600';

    /**
     * 16:00 until 18:00
     */
    const TIME_FRAME_16_18 = '16001800';

    /**
     * 18:00 until 20:00
     */
    const TIME_FRAME_18_20 = '18002000';

    /**
     * 19:00 until 21:00
     */
    const TIME_FRAME_19_21 = '19002100';

    /**
     * @var string
     *
     * Min length: 8
     * Max length: 8
     *
     * Time frame of delivery, valid values are
     * 10001200: 10:00 until 12:00
     * 12001400: 12:00 until 14:00
     * 14001600: 14:00 until 16:00
     * 16001800: 16:00 until 18:00
     * 18002000: 18:00 until 20:00
     * 19002100: 19:00 until 21:00
     */
    public $type;

}