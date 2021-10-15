<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class WeightToHighForV62WP
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Status
 */
class WeightToHighForV62WP extends HardValidationError {

    protected $messageEnglish = 'Maximum permissible weight for merchandise mail: 1 kg. Shipments up to max. 31.5 kg can be ordered as DHL Paket';

    protected $messageGerman  = 'Maximal zulässiges Gewicht für Warenpost: 1 kg. Sendungen bis max. 31,5 kg können als DHL Paket beauftragt werden';
}
