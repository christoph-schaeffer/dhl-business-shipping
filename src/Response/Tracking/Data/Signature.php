<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking\Data;

use ChristophSchaeffer\Dhl\BusinessShipping\Utility\XmlParser;

/**
 * Class Signature
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Response\Tracking\Data
 */
class Signature {
    /**
     * @var string
     *
     * The date of the signature. format: "DD.MM.YYYY"
     */
    public $eventDate;
    /**
     * @var string
     *
     * the mime type of the image file. This is usually "image/gif".
     */
    public $mimeType;
    /**
     * @var false|string
     *
     * an image of the signature in binary format. you can save it with file_put_contents().
     */
    public $image;

    /**
     * @param \SimpleXMLElement $rawSignatureData
     */
    public function __construct(\SimpleXMLElement $rawSignatureData) {
        XmlParser::mapXmlAttributesToObjectProperties($rawSignatureData, $this);
        $this->image = hex2bin($this->image); // converting the image to binary format
    }
}
