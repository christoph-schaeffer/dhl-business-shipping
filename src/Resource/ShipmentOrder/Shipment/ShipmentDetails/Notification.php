<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ShipmentDetails;

/**
 * Class Notification
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ShipmentDetails
 *
 * Mechanism to send notifications by email after successful manifesting of shipment.
 */
class Notification {

    /**
     * @var string
     *
     * Min length: 0
     * Max length: 70
     *
     * Email address of the recipient. Mandatory if Notification is set.
     * To use multiple email addresses separate them with a comma (,).
     * This is used to send notifications to the recipient regarding the shipments status.
     */
    public $recipientEmailAddress;

    /**
     * @var string
     *
     * Optional
     *
     * Min length: 0
     * Max length: 35
     *
     * You may choose between a standard DHL e-mail text (no ID needed)
     * or configure an individual text within the section "Administration".
     */
    public $templateId;

}
