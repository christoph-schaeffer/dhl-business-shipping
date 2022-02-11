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
                if(is_bool($value)):
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
     * @throws \Exception
     */
    public static function parseFromXml($xmlString) {
       $parsed = simplexml_load_string($xmlString);

       if($parsed === false):
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
     * @param string $camelCase
     * @return string
     */
    public static function kebabCaseToCamelCase($camelCase) {
        return trim(lcfirst(str_replace('-', '', ucwords($camelCase, '-'))));
    }



    /**
     * @param \SimpleXMLElement $rawResponse
     * @param Object $object
     *
     * @return Object
     */
    public static function mapXmlAttributesToObjectProperties(\SimpleXMLElement $rawResponse, $object) {
        $attributes = (array)((array)$rawResponse->attributes())['@attributes'];
        foreach($attributes as $property => $value):
            $propertyInCamelCase = self::kebabCaseToCamelCase($property);
            if(property_exists($object, $propertyInCamelCase)):
                $object->{$propertyInCamelCase} = $value;
            endif;
        endforeach;

        return $object;
    }

}

?>
