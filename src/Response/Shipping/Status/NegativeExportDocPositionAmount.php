<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status;

/**
 * Class NegativeExportDocPositionAmount
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class NegativeExportDocPositionAmount extends HardValidationError {

    protected $messageEnglish = 'The quantity of an item must be positive. Please note that discounts and payments via voucher are not relevant for customs.';

    protected $messageGerman  = 'Die Menge eines Artikels muss positiv sein. Beachten Sie bitte, dass Rabatte und Bezahlungen über Gutschein nicht zollrelevant sind.';

}
