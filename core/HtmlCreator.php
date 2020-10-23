<?php
/**
 * Created by PhpStorm.
 * User: Юра
 * Date: 20.10.2020
 * Time: 22:15
 */

namespace core;


class HtmlCreator
{
    public static function CreateSelect($data)
    {
        $result = '';
        foreach ($data as $key => $value) {
            $result .= "<select class='".$value['class_name']."' name='" .$key. "'onchange='sendingForm(\"ships\")'>";
            foreach ($value['values'] as $key2 => $elem) {
                $result .= "<option class='".$value['class_childs']."' value = '".$key2."'>". $elem . "</option>";
            }
            $result .= "</select>";
        }
        return $result;
    }
}