<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment;

/**
 * Class ShipmentDetails
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment
 *
 * Contains the information of the shipment product code, weight and size characteristics and services to be used.
 */
class ShipmentDetails {

    const PRODUCT_COURIER_PREFERRED_TIME        = 'V06WZ';
    const PRODUCT_COURIER_SAME_DAY              = 'V06TG';
    const PRODUCT_DHL_CONNECT                   = 'V55PAK';
    const PRODUCT_EUROPE                        = 'V54EPAK';
    const PRODUCT_INTERNATIONAL                 = 'V53WPAK';
    const PRODUCT_NATIONAL                      = 'V01PAK';
    const PRODUCT_PARCEL_AUSTRIA                = 'V86PARCEL';
    const PRODUCT_PARCEL_CONNECT                = 'V87PARCEL';
    const PRODUCT_PARCEL_INTERNATIONAL          = 'V82PARCEL';
    const PRODUCT_SAME_DAY                      = 'V06PAK';
    const PRODUCT_MAIL_OF_GOODS                 = 'V62WP';
    const PRODUCT_MAIL_OF_GOODS_INTERNATIONAL   = 'V66WPI';

    /**
     * @var ShipmentDetails\BankData
     *
     * Optional
     *
     * Bank data can be provided here for different purposes. E.g. if COD is booked as service, bank data must be
     * provided by DHL customer (mandatory server logic). The collected money will be transferred to specified bank
     * account.
     */
    public $BankData;

    /**
     * @var ShipmentDetails\Notification
     *
     * Optional
     *
     * Mechanism to send notifications by email after successful manifesting of shipment.
     */
    public $Notification;

    /**
     * @var ShipmentDetails\Service
     *
     * Use one dedicated Service object for each service to be booked with the shipment product. Add another Service
     * object for booking a further service and so on. Successful booking of a particular service depends on account
     * permissions and product's service combinatorics. I.e. not every service is allowed for every product, or can be
     * combined with all other allowed services.
     */
    public $Service;

    /**
     * @var ShipmentDetails\ShipmentItem
     *
     * For every parcel specified, contains weight in kg, length in cm, width in cm and height in cm.
     */
    public $ShipmentItem;

    /**
     * @var string
     *
     * Min length: 14
     * Max length: 14
     *
     * DHL account number.
     */
    public $accountNumber;

    /**
     * @var string
     *
     * Optional
     *
     * Min length: 0
     * Max length: 50
     *
     * Name of a cost center.
     */
    public $costCentre;

    /**
     * @var string
     *
     * Optional
     *
     * Min length: 0
     * Max length: 35
     *
     * A reference number that the client can assign for better association purposes. Appears on shipment label.
     * e.g. order number, customer number etc.
     */
    public $customerReference;

    /**
     * @var string
     *
     * Determines the DHL Paket product to be ordered.
     * V01PAK: DHL PAKET / National package
     * V53WPAK: DHL PAKET International / International package
     * V54EPAK: DHL Europaket / Europe package
     * V06PAK: DHL PAKET Taggleich / Same day package
     * V06TG: Kurier Taggleich / Same day courier
     * V06WZ: Kurier Wunschzeit / Preferred time courier
     * V86PARCEL: DHL PAKET Austria / Austria parcel
     * V87PARCEL: DHL PAKET Connect / DHL Connect parcel
     * V82PARCEL: DHL PAKET International / International parcel
     * V62WP: DHL Warenpost / DHL mail of goods
     * V66WPI: DHL Warenpost International / DHL mail of goods international
     */
    public $product = self::PRODUCT_NATIONAL;

    /**
     * @var string
     *
     * Optional
     *
     * Min length: 14
     * Max length: 14
     *
     * DHL account number
     */
    public $returnShipmentAccountNumber;

    /**
     * @var string
     *
     * Optional
     *
     * Min length: 0
     * Max length: 35
     *
     * A reference number that the client can assign for better association purposes. Appears on return shipment label.
     * e.g. order number, customer number etc.
     */
    public $returnShipmentReference;

    /**
     * @var string
     *
     * Optional
     *
     * Format: YYYY-MM-DD
     *
     * Min length: 10
     * Max length: 10
     *
     * Date of shipment should be close to current date and must not be in the past.
     */
    public $shipmentDate;

    /**
     * ShipmentDetails constructor.
     */
    public function __construct() {
        $this->Notification = new ShipmentDetails\Notification();
        $this->BankData     = new ShipmentDetails\BankData();
        $this->ShipmentItem = new ShipmentDetails\ShipmentItem();
        $this->Service      = new ShipmentDetails\Service();
    }


}