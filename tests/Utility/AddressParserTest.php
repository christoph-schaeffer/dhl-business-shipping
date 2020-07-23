<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Utility;

use ChristophSchaeffer\Dhl\BusinessShipping\Test\AbstractUnitTest;
use ChristophSchaeffer\Dhl\BusinessShipping\Utility\AddressParser;

/**
 * Class AddressParserTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test\Utility
 */
class AddressParserTest extends AbstractUnitTest {

    /**
     * @return array[]
     */
    public function providerUseRegexPatternWithHouseNumberAtEnd() {
        return [
            ['König-Ludwig-Str. 24c', ['König-Ludwig-Str.', '24c']],
            ['Kaiserstr. 85 d', ['Kaiserstr.', '85 d']],
            ['Moltkestraße 12-14', ['Moltkestraße', '12-14']],
            ['Moltkestraße 12- 14', ['Moltkestraße', '12- 14']],
            ['Moltkestraße 12 -14', ['Moltkestraße', '12 -14']],
            ['Moltkestraße 12 - 14', ['Moltkestraße', '12 - 14']],
            ['Haupstrasse 48/50', ['Haupstrasse', '48/50']],
            ['Haupstrasse 48/ 50', ['Haupstrasse', '48/ 50']],
            ['Haupstrasse 48 /50', ['Haupstrasse', '48 /50']],
            ['Haupstrasse 48 / 50', ['Haupstrasse', '48 / 50']],
            ['Schönhauser-Allée 1bis3', ['Schönhauser-Allée', '1bis3']],
            ['Schönhauser-Allée 1bis 3', ['Schönhauser-Allée', '1bis 3']],
            ['Schönhauser-Allée 1 bis3', ['Schönhauser-Allée', '1 bis3']],
            ['Schönhauser-Allée 1 bis 3', ['Schönhauser-Allée', '1 bis 3']],
            ['Schönhauser-Allée 123', ['Schönhauser-Allée', '123']],
            ['Schönhauser- Allée 1', ['Schönhauser- Allée', '1']],
            ['Schönhauser -Allée 22', ['Schönhauser -Allée', '22']],
            ['Schönhauser - Allée 333', ['Schönhauser - Allée', '333']],
            ['Straßburgerstr.8', ['Straßburgerstr.', '8']],
            ['Straßburgerstr8', ['Straßburgerstr', '8']],
            ['Straßburgerstrasse8', ['Straßburgerstrasse', '8']],
            ['Straßburgerstraße8', ['Straßburgerstraße', '8']],
            ['Straßburgerstraße8', ['Straßburgerstraße', '8']],
            ['Rue de Wattrelos 6', ['Rue de Wattrelos', '6']],
            ['Rue de Wattrelos6', ['Rue de Wattrelos', '6']]
        ];
    }

    /**
     * @return array[]
     */
    public function providerUseRegexPatternWithHouseNumberAtFront() {
        return [
            ['24c König-Ludwig-Str.', ['König-Ludwig-Str.', '24c']],
            ['85 d Kaiserstr.', ['Kaiserstr.', '85 d']],
            ['12-14 Moltkestraße', ['Moltkestraße', '12-14']],
            ['12- 14 Moltkestraße', ['Moltkestraße', '12- 14']],
            ['12 -14 Moltkestraße', ['Moltkestraße', '12 -14']],
            ['12 - 14 Moltkestraße', ['Moltkestraße', '12 - 14']],
            ['48/50 Haupstrasse', ['Haupstrasse', '48/50']],
            ['48/ 50 Haupstrasse', ['Haupstrasse', '48/ 50']],
            ['48 /50 Haupstrasse', ['Haupstrasse', '48 /50']],
            ['48 / 50 Haupstrasse', ['Haupstrasse', '48 / 50']],
            ['1bis3 Schönhauser-Allée', ['Schönhauser-Allée', '1bis3']],
            ['1bis 3 Schönhauser-Allée', ['Schönhauser-Allée', '1bis 3']],
            ['1 bis3 Schönhauser-Allée', ['Schönhauser-Allée', '1 bis3']],
            ['1 bis 3 Schönhauser-Allée', ['Schönhauser-Allée', '1 bis 3']],
            ['123 Schönhauser-Allée', ['Schönhauser-Allée', '123']],
            ['1 Schönhauser- Allée', ['Schönhauser- Allée', '1']],
            ['22 Schönhauser -Allée', ['Schönhauser -Allée', '22']],
            ['333 Schönhauser - Allée', ['Schönhauser - Allée', '333']],
            ['8Straßburgerstr.', ['Straßburgerstr.', '8']],
            ['8Straßburgerstr', ['Straßburgerstr', '8']],
            ['8Straßburgerstrasse', ['Straßburgerstrasse', '8']],
            ['8Straßburgerstraße', ['Straßburgerstraße', '8']],
            ['8Straßburgerstraße', ['Straßburgerstraße', '8']],
            ['6 Rue de Wattrelos', ['Rue de Wattrelos', '6']],
            ['6Rue de Wattrelos', ['Rue de Wattrelos', '6']]
        ];
    }

    /**
     * @return array[]
     */
    public function providerValidateHouseNumberWithInValidData() {
        return [
            ['Keine Hausnummer'],
            ['ÖÄÜ'],
            ['Eins'],
            ['Zweihundert'],
            ['a-z'],
            [''],
            [NULL],
            [TRUE],
            [FALSE]
        ];
    }

    /**
     * @return array[]
     */
    public function providerValidateHouseNumberWithValidData() {
        return [
            ['22c'],
            ['85 d'],
            ['12-14'],
            ['12- 14'],
            ['12 -14'],
            ['12 - 14'],
            ['48/50'],
            ['48/ 50'],
            ['48 /50'],
            ['48 / 50'],
            ['1bis3'],
            ['1bis 3'],
            ['1 bis3'],
            ['1 bis 3'],
            ['123'],
            ['1'],
            ['22'],
            ['333'],
            ['8'],
            ['6'],
            [1],
            [22],
            [333]
        ];
    }

    /**
     * @return array[]
     */
    public function providerValidateStreetAndHouseNumberWithInvalidData() {
        return [
            [[NULL, NULL, NULL], [NULL, NULL]],
            [['König-Ludwig-Str.', NULL, NULL], ['König-Ludwig-Str.', NULL]],
            [['König-Ludwig-Str.', 24, NULL], ['König-Ludwig-Str.', 24]],
            [[NULL, 24, NULL], [NULL, NULL]],
            [[NULL, 24, 24], ['24', NULL]],
            [[24, 24, 24], ['24', NULL]],
            [['König-Ludwig-Str.', 'König-Ludwig-Str.', 'König-Ludwig-Str.'], ['König-Ludwig-Str.', NULL]]
        ];
    }

    /**
     * @return array[]
     */
    public function providerValidateStreetAndHouseNumberWithValidData() {
        return [
            [['König-Ludwig-Str.', 24, 'König-Ludwig-Str. 24'], ['König-Ludwig-Str.', 24]],
            [['König-Ludwig-Str.', '24c', 'König-Ludwig-Str. 24c'], ['König-Ludwig-Str.', '24c']],
            [['Kaiserstr.', '85 d', '85 d Kaiserstr.'], ['Kaiserstr.', '85 d']],
            [['Moltkestraße', '12-14', 'Moltkestraße 12-14'], ['Moltkestraße', '12-14']],
            [['Moltkestraße', '12 - 14', 'Moltkestraße 12 - 14'], ['Moltkestraße', '12 - 14']],
            [['Haupstrasse', '48/50', 'Haupstrasse'], ['Haupstrasse', '48/50']],
            [['Schönhauser-Allée', '1 bis 3', 'Schönhauser-Allée 1 bis 3'], ['Schönhauser-Allée', '1 bis 3']],
            [['Straßburgerstr', '8', '8Straßburgerstr'], ['Straßburgerstr', '8']],
            [['Rue de Wattrelos', '6', 'Rue de Wattrelos 6'], ['Rue de Wattrelos', '6']]
        ];
    }

    /**
     * @return array[]
     */
    public function providerValidateStreetNameWithInvalidData() {
        return [
            ['123'],
            ['1'],
            ['22'],
            ['333'],
            ['8'],
            ['6'],
            [1],
            [22],
            [333],
            [''],
            [NULL],
            [TRUE],
            [FALSE]
        ];
    }

    /**
     * @return array[]
     */
    public function providerValidateStreetNameWithValidData() {
        return [
            ['König-Ludwig-Str.'],
            ['Kaiserstr.'],
            ['Moltkestraße'],
            ['Haupstrasse'],
            ['Schönhauser-Allée'],
            ['Schönhauser- Allée'],
            ['Schönhauser -Allée'],
            ['Schönhauser - Allée'],
            ['Straßburgerstr.'],
            ['Rue de Wattrelos']
        ];
    }

    /**
     * @param string   $original
     * @param string[] $expected
     *
     * @dataProvider providerUseRegexPatternWithHouseNumberAtEnd
     */
    public function testSplitStreetAndHouseNumberWithHouseNumberAtEnd($original, $expected) {
        $parsed = AddressParser::splitStreetAndHouseNumber($original);

        $this->assertEquals($expected, $parsed);
    }

    /**
     * @param string   $original
     * @param string[] $expected
     *
     * @dataProvider providerUseRegexPatternWithHouseNumberAtFront
     */
    public function testSplitStreetAndHouseNumberWithHouseNumberAtFront($original, $expected) {
        $parsed = AddressParser::splitStreetAndHouseNumber($original);

        $this->assertEquals($expected, $parsed);
    }

    /**
     * @param string   $original
     * @param string[] $expected
     *
     * @dataProvider providerUseRegexPatternWithHouseNumberAtEnd
     * @throws \ReflectionException
     */
    public function testUseRegexPatternWithHouseNumberAtEnd($original, $expected) {
        $parsed = $this->runProtectedMethod((new AddressParser()), 'useRegexPattern', [$original]);

        $this->assertEquals($expected, $parsed);
    }

    /**
     * @param string   $original
     * @param string[] $expected
     *
     * @dataProvider providerUseRegexPatternWithHouseNumberAtFront
     * @throws \ReflectionException
     */
    public function testUseRegexPatternWithHouseNumberAtFront($original, $expected) {
        $parsed = $this->runProtectedMethod((new AddressParser()), 'useRegexPattern', [$original]);

        $this->assertEquals($expected, $parsed);
    }

    /**
     * @param mixed $notAHouseNumber
     *
     * @dataProvider providerValidateHouseNumberWithInvalidData
     * @throws \ReflectionException
     */
    public function testValidateHouseNumberWithInvalidData($notAHouseNumber) {
        $isValidHouseNumber = $this->runProtectedMethod((new AddressParser()), 'validateHouseNumber', [$notAHouseNumber]);

        $this->assertFalse($isValidHouseNumber);
    }

    /**
     * @param string $houseNumber
     *
     * @dataProvider providerValidateHouseNumberWithValidData
     * @throws \ReflectionException
     */
    public function testValidateHouseNumberWithValidData($houseNumber) {
        $isValidHouseNumber = $this->runProtectedMethod((new AddressParser()), 'validateHouseNumber', [$houseNumber]);

        $this->assertTrue($isValidHouseNumber);
    }

    /**
     * @param string[] $args
     * @param string[] $expected
     *
     * @dataProvider providerValidateStreetAndHouseNumberWithInvalidData
     * @throws \ReflectionException
     */
    public function testValidateStreetAndHouseNumberWithInvalidData($args, $expected) {
        $validated = $this->runProtectedMethod((new AddressParser()), 'validateStreetAndHouseNumber', $args);

        $this->assertEquals($expected, $validated);
    }

    /**
     * @param string[] $args
     * @param string[] $expected
     *
     * @dataProvider providerValidateStreetAndHouseNumberWithValidData
     * @throws \ReflectionException
     */
    public function testValidateStreetAndHouseNumberWithValidData($args, $expected) {
        $validated = $this->runProtectedMethod((new AddressParser()), 'validateStreetAndHouseNumber', $args);

        $this->assertEquals($expected, $validated);
    }

    /**
     * @param string $streetName
     *
     * @dataProvider providerValidateStreetNameWithInvalidData
     * @throws \ReflectionException
     */
    public function testValidateStreetNameWithInvalidData($streetName) {
        $isValidStreetName = $this->runProtectedMethod((new AddressParser()), 'validateStreetName', [$streetName]);

        $this->assertFalse($isValidStreetName);
    }

    /**
     * @param string $streetName
     *
     * @dataProvider providerValidateStreetNameWithValidData
     * @throws \ReflectionException
     */
    public function testValidateStreetNameWithValidData($streetName) {
        $isValidStreetName = $this->runProtectedMethod((new AddressParser()), 'validateStreetName', [$streetName]);

        $this->assertTrue($isValidStreetName);
    }
}

?>