<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ShipmentDetails;


/**
 * Class Service
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ShipmentDetails
 *
 * Container for all services
 * Additional services e.g. preferred location, day of delivery, delivery timeframe.
 * Successful booking of a particular service depends on account permissions and product's service combinatorics.
 * I.e. not every service is allowed for every product, or can be combined with all other allowed services.
 * The service bundles that contain all services are the following.
 */
class Service {

    /**
     * @var Service\AdditionalInsurance
     *
     * Insure shipment with higher than standard amount.
     */
    public $AdditionalInsurance;

    /**
     * @var Service\BulkyGoods
     *
     * Service to ship bulky goods.
     */
    public $BulkyGoods;

    /**
     * @var Service\CashOnDelivery
     *
     * Service Cash on delivery
     */
    public $CashOnDelivery;

    /**
     * @var Service\DayOfDelivery
     *
     * Day of Delivery for product: V06TG: Kurier Taggleich; V06WZ: Kurier Wunschzeit
     */
    public $DayOfDelivery;

    /**
     * @var Service\DeliveryTimeframe
     *
     * Timeframe of delivery for product: V06TG: Kurier Taggleich; V06WZ: Kurier Wunschzeit
     */
    public $DeliveryTimeframe;

    /**
     * @var Service\Endorsement
     *
     * Service endorsement is used to specify handling if recipient not met There are the following types are allowed:
     *
     * For Germany:
     * SOZU (Return immediately)
     * ZWZU (2nd attempt of Delivery)
     *
     * for International:
     * IMMEDIATE (Sending back immediately to sender)
     * AFTER_DEADLINE (Sending back immediately to sender after expiration of time)
     * ABANDONMENT (Abandonment of parcel at the hands of sender (free of charge))
     */
    public $Endorsement;

    /**
     * @var Service\GoGreen
     *
     * Climate neutral shipping
     */
    public $GoGreen;

    /**
     * @var Service\IdentCheck
     *
     * Service configuration for IdentCheck.
     */
    public $IdentCheck;

    /**
     * @var Service\IndividualSenderRequirement
     *
     * Individual sender requirements for product:
     * V06TG: Kurier Taggleich
     * V06WZ: Kurier Wunschzeit
     */
    public $IndividualSenderRequirement;

    /**
     * @var Service\NamedPersonOnly
     *
     * Invoke service Named Person Only.
     */
    public $NamedPersonOnly;

    /**
     * @var Service\NoNeighbourDelivery
     *
     * Invoke service No Neighbour Delivery
     */
    public $NoNeighbourDelivery;

    /**
     * @var Service\NoticeOfNonDeliverability
     *
     * Service Notice of non-deliverability.
     */
    public $NoticeOfNonDeliverability;

    /**
     * @var Service\PackagingReturn
     *
     * Service for package return.
     */
    public $PackagingReturn;

    /**
     * @var Service\ParcelOutletRouting
     *
     * Service configuration for ParcelOutletRouting. Details can be an email-address, if not set receiver email will
     * be used
     */
    public $ParcelOutletRouting;

    /**
     * @var Service\Perishables
     *
     * DHL Kurier Verderbliche Ware
     */
    public $Perishables;

    /**
     * @var Service\PreferredDay
     *
     * Service preferred day of delivery
     */
    public $PreferredDay;

    /**
     * @var Service\PreferredLocation
     *
     * Service preferred location
     */
    public $PreferredLocation;

    /**
     * @var Service\PreferredNeighbour
     *
     * Service preferred neighbour
     */
    public $PreferredNeighbour;

    /**
     * @var Service\PreferredTime
     *
     * Preferred Time of delivery for product:
     * V01PAK: DHL PAKET
     * V06PAK: DHL PAKET TAGGLEICH
     */
    public $PreferredTime;

    /**
     * @var Service\Premium
     *
     * Premium for fast and safe delivery of international shipments.
     */
    public $Premium;

    /**
     * @var Service\ReturnImmediately
     *
     * Service of immediatly shipment return in case of non sucessful delivery for product: V06PAK: DHL PAKET TAGGLEICH
     */
    public $ReturnImmediately;

    /**
     * @var Service\ReturnReceipt
     *
     * Invoke service return receipt.
     */
    public $ReturnReceipt;

    /**
     * @var Service\VisualCheckOfAge
     *
     * Service visual age check
     */
    public $VisualCheckOfAge;

    /**
     * Service constructor.
     */
    public function __construct() {
        $this->AdditionalInsurance         = new Service\AdditionalInsurance();
        $this->BulkyGoods                  = new Service\BulkyGoods();
        $this->CashOnDelivery              = new Service\CashOnDelivery();
        $this->DayOfDelivery               = new Service\DayOfDelivery();
        $this->DeliveryTimeframe           = new Service\DeliveryTimeframe();
        $this->Endorsement                 = new Service\Endorsement();
        $this->GoGreen                     = new Service\GoGreen();
        $this->IdentCheck                  = new Service\IdentCheck();
        $this->IndividualSenderRequirement = new Service\IndividualSenderRequirement();
        $this->NamedPersonOnly             = new Service\NamedPersonOnly();
        $this->NoNeighbourDelivery         = new Service\NoNeighbourDelivery();
        $this->NoticeOfNonDeliverability   = new Service\NoticeOfNonDeliverability();
        $this->PackagingReturn             = new Service\PackagingReturn();
        $this->ParcelOutletRouting         = new Service\ParcelOutletRouting();
        $this->Perishables                 = new Service\Perishables();
        $this->PreferredDay                = new Service\PreferredDay();
        $this->PreferredLocation           = new Service\PreferredLocation();
        $this->PreferredNeighbour          = new Service\PreferredNeighbour();
        $this->PreferredTime               = new Service\PreferredTime();
        $this->Premium                     = new Service\Premium();
        $this->ReturnImmediately           = new Service\ReturnImmediately();
        $this->ReturnReceipt               = new Service\ReturnReceipt();
        $this->ShipmentHandling            = new Service\ShipmentHandling();
        $this->VisualCheckOfAge            = new Service\VisualCheckOfAge();
    }

}