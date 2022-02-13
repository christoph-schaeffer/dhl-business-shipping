<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit\Utility;

use ChristophSchaeffer\Dhl\BusinessShipping\Test\AbstractUnitTest;
use ChristophSchaeffer\Dhl\BusinessShipping\Utility\CountryCodeConversion;

/**
 * Class CountryCodeConversionTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test\Utility
 */
class CountryCodeConversionTest extends AbstractUnitTest {

    /**
     * @return array[]
     */
    public function providerCountryCodeToCountryWithInvalidData() {
        return [
            [NULL],
            [1],
            [22],
            [0],
            [-23],
            [TRUE],
            [FALSE],
            ['GER'],
            ['ENG'],
            ['DE1'],
            ['1'],
            ['Germany'],
            ['Deutschland'],
            ['United States']
        ];
    }

    /**
     * @return array[]
     */
    public function providerCountryCodeToCountryWithValidData() {
        return [
            ['DE', 'Germany'],
            ['de', 'Germany'],
            ['De', 'Germany'],
            ['dE', 'Germany'],
            ['NL', 'Netherlands'],
            ['AT', 'Austria'],
            ['CH', 'Switzerland'],
            ['FR', 'France'],
            ['ES', 'Spain'],
            ['IT', 'Italy'],
            ['PL', 'Poland'],
            ['GR', 'Greece'],
            ['RO', 'Romania'],
            ['IE', 'Ireland'],
            ['UA', 'Ukraine'],
            ['TR', 'Turkey'],
            ['DK', 'Denmark'],
            ['CZ', 'Czech Republic'],
            ['LU', 'Luxembourg'],
            ['PT', 'Portugal'],
            ['MX', 'Mexico'],
            ['BR', 'Brazil'],
            ['RU', 'Russian Federation'],
            ['NO', 'Norway'],
            ['FI', 'Finland'],
            ['SE', 'Sweden'],
            ['GB', 'United Kingdom'],
            ['US', 'United States'],
            ['CN', 'China'],
            ['JP', 'Japan'],
            ['KR', 'Korea, Republic of'],
            ['IN', 'India'],
            ['AU', 'Australia'],
            ['CA', 'Canada'],
            ['BO', 'Bolivia'],
            ['BQ', 'Bonaire, Sint Eustatius and Saba'],
            ['CI', 'Cote d\'Ivoire'],
            ['LA', 'Lao People\'s Democratic Republic']
        ];
    }

    /**
     * @return array[]
     */
    public function providerCountryToCountryCodeWithInvalidData() {
        return [
            [NULL],
            [1],
            [22],
            [0],
            [-23],
            [TRUE],
            [FALSE],
            ['GER'],
            ['ENG'],
            ['DE1'],
            ['1'],
            ['DE'],
            ['GB'],
            ['USA']
        ];
    }

    /**
     * @return array[]
     */
    public function providerCountryToCountryCodeWithValidData() {
        return [
            ['Deutschland', 'DE'],
            ['deutschland', 'DE'],
            ['Germany', 'DE'],
            ['germany', 'DE'],
            ['Netherlands', 'NL'],
            ['Austria', 'AT'],
            ['Switzerland', 'CH'],
            ['France', 'FR'],
            ['Spain', 'ES'],
            ['Italy', 'IT'],
            ['Poland', 'PL'],
            ['Greece', 'GR'],
            ['Romania', 'RO'],
            ['Ireland', 'IE'],
            ['Ukraine', 'UA'],
            ['Turkey', 'TR'],
            ['Denmark', 'DK'],
            ['Czech Republic', 'CZ'],
            ['Luxembourg', 'LU'],
            ['Portugal', 'PT'],
            ['Mexico', 'MX'],
            ['Brazil', 'BR'],
            ['Russian Federation', 'RU'],
            ['RussianFederation', 'RU'],
            ['Norway', 'NO'],
            ['Finland', 'FI'],
            ['Sweden', 'SE'],
            ['United Kingdom', 'GB'],
            ['United States', 'US'],
            ['China', 'CN'],
            ['Japan', 'JP'],
            ['Korea, Republic of', 'KR'],
            ['India', 'IN'],
            ['Australia', 'AU'],
            ['Canada', 'CA'],
            ['Bolivia', 'BO'],
            ['Bonaire, Sint Eustatius and Saba', 'BQ'],
            ['Cote d\'Ivoire', 'CI'],
            ['Lao People\'s Democratic Republic', 'LA']
        ];
    }

    /**
     * @param string $countryCode
     *
     * @dataProvider providerCountryCodeToCountryWithInvalidData
     */
    public function testCountryCodeToCountryWithInvalidData($countryCode) {
        $result = CountryCodeConversion::countryCodeToCountry($countryCode);

        $this->assertNull($result);
    }

    /**
     * @param string $countryCode
     * @param string $expectedCountry
     *
     * @dataProvider providerCountryCodeToCountryWithValidData
     */
    public function testCountryCodeToCountryWithValidData($countryCode, $expectedCountry) {
        $country = CountryCodeConversion::countryCodeToCountry($countryCode);

        $this->assertEquals($expectedCountry, $country);
    }

    /**
     * @param string $country
     *
     * @dataProvider providerCountryToCountryCodeWithInvalidData
     */
    public function testCountryToCountryCodeWithInvalidData($country) {
        $result = CountryCodeConversion::countryToCountryCode($country);

        $this->assertNull($result);
    }

    /**
     * @param string $country
     * @param string $expectedCountryCode
     *
     * @dataProvider providerCountryToCountryCodeWithValidData
     */
    public function testCountryToCountryCodeWithValidData($country, $expectedCountryCode) {
        $countryCode = CountryCodeConversion::countryToCountryCode($country);

        $this->assertEquals($expectedCountryCode, $countryCode);
    }
}

?>