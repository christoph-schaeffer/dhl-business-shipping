<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment;

/**
 * Class ExportDocument
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment
 *
 * For international shipments, this section contains information about the exported goods relevant for customs.
 * For international shipments: commercial invoice, dispatch note (CP71) and customs declaration (CN23)
 * are printed into returned label information. Data is also transferred as electronic declaration to customs.
 * For european shipments. For international shipments, ExportDocument can contain one or more positions in child
 * element.
 */
class ExportDocument {

    const EXPORT_TYPE_OTHER             = 'OTHER';
    const EXPORT_TYPE_PRESENT           = 'PRESENT';
    const EXPORT_TYPE_COMMERCIAL_SAMPLE = 'COMMERCIAL_SAMPLE';
    const EXPORT_TYPE_DOCUMENT          = 'DOCUMENT';
    const EXPORT_TYPE_RETURN_OF_GOODS   = 'RETURN_OF_GOODS';
    const EXPORT_TYPE_COMMERCIAL_GOODS  = 'COMMERCIAL_GOODS';

    const TERMS_OF_TRADE_DELIVERY_DUTY_PAID                          = 'DDP';
    const TERMS_OF_TRADE_DELIVERY_DUTY_PAID_EXCLUDING_VAT            = 'DXV';
    const TERMS_OF_TRADE_DELIVERY_AT_PLACE                           = 'DAP';
    /**
     * @deprecated
     */
    const TERMS_OF_TRADE_DELIVERY_DUTY_UNPAID                        =  self::TERMS_OF_TRADE_DELIVERY_AT_PLACE;
    const TERMS_OF_TRADE_DELIVERY_DUTY_PAID_EXCLUDING_DUTIES_TAX_VAT = 'DDX';
    const TERMS_OF_TRADE_CARRIAGE_PAID_TO                            = 'CPT'; // within EU only

    /**
     * @var ExportDocument\ExportDocPosition[]
     *
     * Max count: 99
     *
     * Optional
     */
    public $ExportDocPosition = [];

    /**
     * @var float
     *
     * Min value: 0.01
     * Max value: infinity
     *
     * Additional custom fees to be payed.
     */
    public $additionalFee;

    /**
     * @var string
     *
     * Optional
     *
     * Min length: 0
     * Max length: 35
     *
     * The attestation number.
     */
    public $attestationNumber;

    /**
     * @var string
     *
     * Optional
     *
     * Min length: 0
     * Max length: 35
     *
     * The customs reference is used by customs authorities to identify economics operators an/or other persons involved.
     * With the given reference, granted authorizations and/or relevant processes in customs clearance an/or taxation
     * can be taken into account.
     */
    public $addresseesCustomsReference;

    /**
     * @var string
     *
     * Optional
     *
     * Min length: 3
     * Max length: 3
     *
     * CustomsCurrency refers to all stated goods / customs values as well as postage costs. The information has to
     * match the currency of the commercial invoice or the invoice for customs purposes. ISO 4217 alpha, p.E.:
     * EUR for Euro
     * USD for US Dollar
     * GBP for British Pound
     */
    public $customsCurrency;

    /**
     * @var string
     *
     * Optional
     *
     * Min length: 0
     * Max length: 35
     *
     * The customs reference is used by customs authorities to identify economics operators an/or other persons involved.
     * With the given reference, granted authorizations and/or relevant processes in customs clearance an/or taxation
     * can be taken into account.
     */
    public $sendersCustomsReference;

    /**
     * @var string
     *
     * Export type ("OTHER", "PRESENT", "COMMERCIAL_SAMPLE", "DOCUMENT", "RETURN_OF_GOODS", "COMMERCIAL_GOODS")
     * (depends on chosen product -> only mandatory for international non EU shipments).
     */
    public $exportType;

    /**
     * @var string
     *
     * Optional
     *
     * Min length: 0
     * Max length: 256
     *
     * Description mandatory if ExportType is OTHER.
     */
    public $exportTypeDescription;

    /**
     * @var string
     *
     * Min length: 0
     * Max length: 35
     *
     * In case invoice has a number, client app can provide it in this field.
     */
    public $invoiceNumber;

    /**
     * @var string
     *
     * Optional
     *
     * Min length: 0
     * Max length: 10
     *
     * The permit number.
     */
    public $permitNumber;

    /**
     * @var string
     *
     * Min length: 0
     * Max length: 35
     *
     * PlaceOfCommital is a City e.g. "BONN"
     */
    public $placeOfCommital;

    /**
     * @var string
     *
     * Optional
     *
     * Min length: 3
     * Max length: 3
     *
     * Element provides terms of trades, incoterms codes:
     * DDP - Delivery Duty Paid
     * DXV - Delivery Duty Paid (excl. VAT )
     * DDU - Delivery Duty Unpaid
     * DDX - Delivery Duty Paid (excl. Duties, taxes and VAT)
     */
    public $termsOfTrade;

    /**
     * @var boolean
     *
     * Optional
     *
     * Sets an electronic export notification.
     */
    public $withElectronicExportNtfctn;

}
