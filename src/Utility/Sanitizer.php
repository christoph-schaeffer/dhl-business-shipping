<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Utility;

/**
 * Class Sanitizer
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Utility
 *
 * Used to remove empty values, or parameters of objects and arrays recursively. It only removes empty strings and
 * null values. empty integers (0) will persist.
 */
class Sanitizer {

    /**
     * @param array $array
     */
    public static function convertBooleanToIntegerArrayRecursive(array &$array) {
        foreach ($array as $key => $value):
            if(is_array($value)):
                self::convertBooleanToIntegerArrayRecursive($value);
            elseif(is_object($value)):
                self::convertBooleanToIntegerObjectRecursive($value);
            elseif(is_bool($value)):
                $array[$key] = $value ? 1 : 0;
            endif;
        endforeach;
    }

    /**
     * @param object $object
     */
    public static function convertBooleanToIntegerObjectRecursive(&$object) {
        if(!is_object($object))
            return;

        foreach ($object as $property => $value):
            if(is_array($value)):
                self::convertBooleanToIntegerArrayRecursive($value);
            elseif(is_object($value)):
                self::convertBooleanToIntegerObjectRecursive($value);
            elseif(is_bool($value)):
                $object->{$property} = $value ? 1 : 0;
            endif;
        endforeach;
    }

    /**
     * @param array $array
     */
    public static function convertFloatToStringArrayRecursive(array &$array) {
        foreach ($array as $key => $value):
            if(is_array($value)):
                self::convertFloatToStringArrayRecursive($value);
            elseif(is_object($value)):
                self::convertFloatToStringObjectRecursive($value);
            elseif(is_float($value)):
                $array[$key] = var_export($value, true);
            endif;
        endforeach;
    }

    /**
     * @param object $object
     */
    public static function convertFloatToStringObjectRecursive(&$object) {
        if(!is_object($object))
            return;

        foreach ($object as $property => $value):
            if(is_array($value)):
                self::convertFloatToStringArrayRecursive($value);
            elseif(is_object($value)):
                self::convertFloatToStringObjectRecursive($value);
            elseif(is_float($value)):
                $object->{$property} = var_export($value, true);
            endif;
        endforeach;
    }

    /**
     * @param array $array
     */
    public static function sanitizeArrayRecursive(array &$array) {
        foreach ($array as $key => $value):
            if(is_array($value)):
                self::sanitizeArrayRecursive($value);
            elseif(is_object($value)):
                self::sanitizeObjectRecursive($value);
            endif;

            $array = self::unsetKeyIfEmpty($array, $value, $key);
        endforeach;

        $array = empty($array) ? NULL : $array;
    }

    /**
     * @param Object $recursiveObject
     */
    public static function sanitizeObjectRecursive(&$recursiveObject) {
        if(!is_object($recursiveObject))
            return;
        $allPropertiesAreNull = TRUE;

        foreach ($recursiveObject as $property => $value):
            if(is_array($value)):
                self::sanitizeArrayRecursive($value);
            elseif(is_object($value)):
                self::sanitizeObjectRecursive($value);
            endif;

            $recursiveObject      = self::unsetPropertyIfEmpty($recursiveObject, $value, $property);
            $allPropertiesAreNull = $value !== NULL && $value !== '' ? FALSE : $allPropertiesAreNull;
        endforeach;

        $recursiveObject = $allPropertiesAreNull ? NULL : $recursiveObject;
    }

    /**
     * @param array      $array
     * @param mixed      $value
     * @param string|int $key
     *
     * @return array
     */
    private static function unsetKeyIfEmpty(array $array, $value, $key) {
        if($value === NULL || $value === ''):
            unset($array[$key]);
        else:
            $array[$key] = $value;
        endif;

        return $array;
    }

    /**
     * @param object $object
     * @param mixed  $value
     * @param string $property
     *
     * @return object
     */
    private static function unsetPropertyIfEmpty($object, $value, $property) {
        if(!is_object($object))
            return $object;

        $clonedObject = clone $object;

        if($value === NULL || $value === ''):
            unset($clonedObject->{$property});
        else:
            $clonedObject->{$property} = $value;
        endif;

        return $clonedObject;
    }

}

?>
