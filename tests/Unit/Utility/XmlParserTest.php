<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit\Utility;

use ChristophSchaeffer\Dhl\BusinessShipping\Exception\Tracking\DhlXmlParseException;
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

    public function providerNullableStringTypeCast() {
        return [
            ['int', '1337',  1337],
            ['int', '1',  1],
            ['int', '0',  0],
            ['int', '-0',  0],
            ['int', '-1',  -1],
            ['int', '-420',  -420],
            ['float', '1337',  1337.0],
            ['float', '1',  1.0],
            ['float', '0',  0.0],
            ['float', '-0',  0.0],
            ['float', '-1',  -1.0],
            ['float', '-420',  -420.0],
            ['float', '1337.1',  1337.1],
            ['float', '1.9',  1.9],
            ['float', '0.2',  0.2],
            ['float', '-0.1',  -0.1],
            ['float', '0.1',  0.1],
            ['float', '0.0001',  0.0001],
            ['float', '-1.01',  -1.01],
            ['float', '-420.1337',  -420.1337],
            ['float', '1.0',  1.0],
            ['bool', '1', TRUE],
            ['bool', 'true', TRUE],
            ['bool', 'TRUE', TRUE],
            ['bool', 'trUe', TRUE],
            ['bool', '', FALSE],
            ['bool', '0', FALSE],
            ['bool', 'false', FALSE],
            ['bool', 'FALSE', FALSE],
            ['bool', 'fALSE', FALSE],
            ['int', '', NULL],
            ['int', NULL, NULL],
            ['float', '', NULL],
            ['float', NULL, NULL],
            ['bool', '', NULL],
            ['bool', NULL, NULL],
            ['', '', NULL],
            ['', NULL, NULL],
            [NULL, '', NULL],
            [NULL, NULL, NULL]
        ];
    }

    public function providerNullableStringTypeCastUnknownTypeException() {
        return [
            ['1337'], [NULL], [''], [FALSE], [1]
        ];
    }

    public function providerKebabCaseToCamelCase() {
        return [
            ['foo', 'foo'],
            ['foo-bar', 'fooBar'],
            ['foo-bar-a', 'fooBarA'],
            ['foo-bar-123', 'fooBar123'],
            ['1337', '1337'],
            ['1337-foo', '1337Foo'],
        ];
    }

    public function testParseFromXml() {
        $actual = XmlParser::parseFromXml('<?xml version="1.0" encoding="UTF-8"?><data code="100" request-id="1337"></data>');
        $this->assertInstanceOf(\SimpleXMLElement::class, $actual);
        $this->assertEquals('100', $actual['code']);
        $this->assertEquals('1337', $actual['request-id']);

        $this->expectException(DhlXmlParseException::class);
        XmlParser::parseFromXml('');
    }

    /**
     * @param string $expectedKebab
     * @param string $camelInput
     *
     * @dataProvider providerKebabCaseToCamelCase
     */
    public function tesCamelCaseTotKebabCase($expectedKebab, $camelInput) {
        $actualKebab = XmlParser::camelCaseToKebabCase($camelInput);
        $this->assertEquals($expectedKebab, $actualKebab);
    }

    /**
     * @param string $kebabInput
     * @param string $expectedCamel
     *
     * @dataProvider providerKebabCaseToCamelCase
     */
    public function testKebabCaseToCamelCase($kebabInput, $expectedCamel) {
        $actualCamel = XmlParser::kebabCaseToCamelCase($kebabInput);
        $this->assertEquals($expectedCamel, $actualCamel);
    }

    /**
     * @param string $type
     * @param string $value
     * @param string $expectedOutput
     *
     * @dataProvider providerNullableStringTypeCast
     */
    public function testNullableStringTypeCast($type, $value, $expectedOutput) {
        $actualOutput = XmlParser::nullableStringTypeCast($type, $value);
        $this->assertEquals($expectedOutput, $actualOutput);
    }

    /**
     * @dataProvider providerNullableStringTypeCastUnknownTypeException
     */
    public function testNullableStringTypeCastUnknownTypeException($type) {
        $this->expectException(DhlXmlParseException::class);
        XmlParser::nullableStringTypeCast($type, 420);
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