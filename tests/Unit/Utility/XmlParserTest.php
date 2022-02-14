<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit\Utility;

use ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit\AbstractUnitTest;
use ChristophSchaeffer\Dhl\BusinessShipping\Utility\XmlParser;

/**
 * Class XmlParserTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test\Unit\Utility
 */
class XmlParserTest extends AbstractUnitTest {

    public function providerMapXmlAttributesToObjectProperties() {
        return [
            [
                simplexml_load_string('<data foo="test"></data>'),
                (object) ['foo' => 'bar', 'bar' => 'foo', 'a' => 0, 'b' => null],
                (object) ['foo' => 'test', 'bar' => 'foo', 'a' => 0, 'b' => null]
            ],
            [
                simplexml_load_string('<data foo-bar="test"></data>'),
                (object) ['fooBar' => 'bar', 'bar' => 'foo', 'a' => 0, 'b' => null],
                (object) ['fooBar' => 'test', 'bar' => 'foo', 'a' => 0, 'b' => null]
            ],
            [
                simplexml_load_string('<data foo-bar="test" bar-foo-a="test2"></data>'),
                (object) ['fooBar' => 'bar', 'bar' => 'foo', 'a' => 0, 'b' => null],
                (object) ['fooBar' => 'test', 'bar' => 'foo', 'a' => 0, 'b' => null]
            ],
            [
                simplexml_load_string('<data foo-bar="test" bar-foo-a="test2"></data>'),
                (object) ['fooBar' => 'bar', 'barFooA' => null, 'bar' => 'foo', 'a' => 0, 'b' => null],
                (object) ['fooBar' => 'test', 'barFooA' => 'test2', 'bar' => 'foo', 'a' => 0, 'b' => null]
            ]
        ];
    }

    /**
     * @param \SimpleXMLElement $xmlElement
     * @param Object $object
     * @param Object $expectedObject
     *
     * @dataProvider providerMapXmlAttributesToObjectProperties
     */
    public function testMapXmlAttributesToObjectProperties(\SimpleXMLElement $xmlElement, $object, $expectedObject) {
        $actualObject = XmlParser::mapXmlAttributesToObjectProperties($xmlElement, $object);
        $this->assertEquals($expectedObject, $actualObject);
    }

}

?>