<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Utility;

/**
 * Class AddressParser
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Utility
 *
 * Used to split strings that have street name and house number in it. However, use it on your own risk even though it
 * works with 99% of european and american addresses it's always better to let the user input their address separately.
 */
class AddressParser {
    const REGEX_PATTERN = '/^(\d* *(?:[a-z\-\/\s]){0,3}\s?\d* *(?:[a-z\-\/\s]){0,3}) *([^\d]*[^\d\s])$|([^\d]*[^\d\s]) *(\d.*)$/';

    /**
     * @param string $streetAndHouseNumber
     *
     * @return array(street, houseNumber)
     */
    public static function splitStreetAndHouseNumber($streetAndHouseNumber) {
        $streetAndHouseNumber = trim($streetAndHouseNumber);

        list($possibleStreet, $possibleHouseNumber) = self::useRegexPattern($streetAndHouseNumber);

        list($street, $houseNumber) =
            self::validateStreetAndHouseNumber($possibleStreet, $possibleHouseNumber, $streetAndHouseNumber);

        return [
            $street,
            $houseNumber
        ];
    }

    /**
     * @param string $streetAndHouseNumber
     *
     * @return array
     */
    private static function useRegexPattern($streetAndHouseNumber) {
        preg_match(self::REGEX_PATTERN, $streetAndHouseNumber, $match);

        if (empty($match[1]) && empty($match[2])):
            $possibleStreet      = empty($match[3]) ? NULL : $match[3];
            $possibleHouseNumber = empty($match[4]) ? NULL : $match[4];
        else:
            $possibleHouseNumber = empty($match[1]) ? NULL : $match[1];
            $possibleStreet      = empty($match[2]) ? NULL : $match[2];
        endif;

        return [trim($possibleStreet), trim($possibleHouseNumber)];
    }

    /**
     * @param string $match
     *
     * @return bool
     */
    private static function validateHouseNumber($match) {
        if (!is_string($match) && !is_integer($match))
            return FALSE;

        $withoutLetters = (string)(int)$match;

        return !empty($match) && !empty($withoutLetters);
    }

    /**
     * @param string $possibleStreet
     * @param string $possibleHouseNumber
     * @param string $streetAndHouseNumber
     *
     * @return array
     */
    private static function validateStreetAndHouseNumber($possibleStreet, $possibleHouseNumber,
                                                         $streetAndHouseNumber) {
        if (self::validateStreetName($possibleStreet)):
            $street = $possibleStreet;

            if (self::validateHouseNumber($possibleHouseNumber)):
                $houseNumber = $possibleHouseNumber;
            else:
                $houseNumber = NULL;
            endif;
        else:
            $streetAndHouseNumber = trim($streetAndHouseNumber);
            $street               = empty($streetAndHouseNumber) ? NULL : $streetAndHouseNumber;
            $houseNumber          = NULL;
        endif;

        return [$street, $houseNumber];
    }

    /**
     * @param string $possibleStreetName
     *
     * @return bool
     */
    private static function validateStreetName($possibleStreetName) {
        return !empty($possibleStreetName) && is_string($possibleStreetName) && !is_numeric(($possibleStreetName));
    }
}

?>