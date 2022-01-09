<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

/**
 * Class EmptyShippingFeeForExportDocument
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 *
 * @comment this error is thrown if
 * ChristophSchaeffer\Dhl\BusinessShipping\Resource\ShipmentOrder\Shipment\ExportDocument->additionalFee
 * is not set
 */
class EmptyShippingFeeForExportDocument extends HardValidationError
{

    protected $messageEnglish = 'Please specify the shipping costs. These are necessary for customs clearance. If you do not charge shipping costs to the recipient, please set it to 0.00.';

    protected $messageGerman = 'Bitte geben Sie die Versandkosten an. Diese sind für die Zollabfertigung notwendig. Wenn Sie dem Empfänger keine Versandkosten berechnen, geben Sie bitte 0,00 an.';

}
