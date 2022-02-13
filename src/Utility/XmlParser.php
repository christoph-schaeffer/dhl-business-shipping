<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Utility;

use ChristophSchaeffer\Dhl\BusinessShipping\Exception\Tracking\DhlXmlParseException;

/**
 * Class XmlParser
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Utility
 */
class XmlParser {

    /**
     * @param object|array $objectOrArray
     * @param string $xmlTag
     * @param string $xmlContent
     */
    public static function parseToXml($objectOrArray, $xmlContent = '', $xmlTag = 'data') {
        $parsed = "<$xmlTag";
        foreach ($objectOrArray as $key => $value):
            if (is_string($value) || is_integer($value) || is_float($value) || is_bool($value)):
                $kebabKey = self::camelCaseToKebabCase($key);
                if (is_bool($value)):
                    $value = $value ? 'true' : 'false';
                endif;

                $parsed .= " $kebabKey=\"$value\"";
            endif;
        endforeach;
        $parsed .= ">$xmlContent</$xmlTag>";

        return $parsed;
    }

    /**
     * @param string $xmlString
     * @return \SimpleXMLElement
     * @throws DhlXmlParseException
     */
    public static function parseFromXml($xmlString) {
        $parsed = simplexml_load_string($xmlString);

        if ($parsed === false):
            throw new DhlXmlParseException($xmlString);
        endif;

        return $parsed;
    }

    /**
     * @param string $camelCase
     * @return string
     */
    public static function camelCaseToKebabCase($camelCase) {
        return ltrim(strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '-$0', $camelCase)), '-');
    }

    /**
     * @param string $kebabCase
     * @return string
     */
    public static function kebabCaseToCamelCase($kebabCase) {
        return trim(lcfirst(str_replace('-', '', ucwords($kebabCase, '-'))));
    }

    /**
     * @param string $type
     * @param string $value
     * @return bool|float|int|null
     *
     * @throws DhlXmlParseException
     */
    public static function nullableStringTypeCast($type, $value) {
        if ($value === '' || $value === null):
            return null;
        endif;

        switch ($type) {
            case 'int':
                return (int)$value;
            case 'float':
                return (float)$value;
            case 'bool':
                return $value === '1' || strtolower($value) === 'true';
        }

        throw new DhlXmlParseException($value, "DHL XML parse error, because the given type ($type) can not be casted");
    }

    /**
     * @param \SimpleXMLElement $rawResponse
     * @param Object $object
     *
     * @return Object
     */
    public static function mapXmlAttributesToObjectProperties(\SimpleXMLElement $rawResponse, $object) {
        $attributes = (array)((array)$rawResponse->attributes())['@attributes'];
        foreach ($attributes as $property => $value):
            $propertyInCamelCase = self::kebabCaseToCamelCase($property);
            if (property_exists($object, $propertyInCamelCase)):
                $object->{$propertyInCamelCase} = $value;
            endif;
        endforeach;

        return $object;
    }

}

?>
