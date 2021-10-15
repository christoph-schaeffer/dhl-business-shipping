<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;


/**
 * Class InvalidExportDocPositionNetWeight
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class InvalidExportDocPositionNetWeight extends HardValidationError {

    protected $messageEnglish = 'The weight/unit field for the items in the customs form must have the format 0.000 kg and contain a value greater than 0.';

    protected $messageGerman  = 'Das Feld Gewicht / Einheit für die Positionen im Zollformular muss das Format 0,000 kg aufweisen und einen Wert größer 0 enthalten.';

}
