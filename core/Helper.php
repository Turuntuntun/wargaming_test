<?php
/**
 * Created by PhpStorm.
 * User: Юра
 * Date: 21.10.2020
 * Time: 14:59
 */

namespace core;

use NumberFormatter;

class Helper
{
    public static function prepareArray($array,$config,$type)
    {
        foreach ($array as $key => $value) {
            if ($value and (in_array($key,$config))) {
                $result[$key] = self::prepareValue($value,$type);
            }
        }
        return $result;
    }

    public static function prepareValue($value,$type)
    {
        if ($type == 'input') {
            return strip_tags($value.'%');
        }
        return strip_tags($value);
    }

    public static function prepareSql($array)
    {
        $sql = "SELECT * FROM `ships` WHERE";
        foreach ($array as $key => $value) {
            if ($key == 'name') {
                $sql .= ' `'.$key . '`LIKE ' . '?';
            } else {
                $sql .= ' `'.$key . '`=:'.$key . ' AND ';
            }
        }
        $sql = trim($sql,'AND ');
        return $sql;
    }

    public static function prepareResult($data,$config,$fields)
    {
        if ($data) {
            foreach ($data as $key => $value) {
                foreach ($value as $key2 => $elem) {
                    if (in_array($key2,$fields)) {
                        $data[$key][$key2] = $config[$key2]['values'][$elem];
                    }
                }
            }
        }
        return $data;
    }

    public static function concut($array1,$array2)
    {
        if ($array1 === false) {
            return $array2;
        }
        if ($array2 === false) {
            return $array1;
        }
        foreach ($array1 as $key => $value) {
            foreach ($array2 as $key2 => $value2) {
                if (isset($value['id']) and isset($value2['id']) and $value['id'] == $value2['id']) {
                    $result[] = $value;
                }
            }
        }
        return $result;
    }

    public static function changeMoney($array,$lang,$field)
    {
        $local = $lang . '_' . strtoupper($lang);
        if ($array) {
            $fmt = numfmt_create( $local, NumberFormatter::CURRENCY );
            foreach ($array as $key => $value) {
                $array[$key][$field] = numfmt_format_currency($fmt, $value[$field],'RUB');
            }
            return $array;
        }
    }
}