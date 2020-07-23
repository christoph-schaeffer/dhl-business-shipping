<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ShipmentDetails;

/**
 * Class BankData
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ShipmentDetails
 *
 * Bank data can be provided here for different purposes. E.g. if COD is booked as service, bank data must be provided
 * by DHL customer (mandatory server logic). The collected money will be transferred to specified bank account.
 */
class BankData {

    /**
     * @var string
     *
     * Min length: 0
     * Max length: 80
     *
     * Name of bank account owner.
     */
    public $accountOwner;

    /**
     * @var string
     *
     * Optional
     *
     * Min length: 0
     * Max length: 35
     *
     * Account reference to customer profile
     */
    public $accountreference;

    /**
     * @var string
     *
     * Min length: 0
     * Max length: 80
     *
     * Name of bank.
     */
    public $bankName;

    /**
     * @var string
     *
     * Optional
     *
     * Min length: 0
     * Max length: 11
     *
     * Bank-Information-Code (BankCCL) of bank account.
     */
    public $bic;

    /**
     * @var string
     *
     * Min length: 0
     * Max length: 34
     *
     * IBAN code of bank account.
     */
    public $iban;

    /**
     * @var string
     *
     * Optional
     *
     * Min length: 0
     * Max length: 35
     *
     * Purpose of bank information.
     */
    public $note1;

    /**
     * @var string
     *
     * Optional
     *
     * Min length: 0
     * Max length: 35
     *
     * Purpose of bank information.
     */
    public $note2;
}