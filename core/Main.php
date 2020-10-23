<?php
/**
 * Created by PhpStorm.
 * User: Юра
 * Date: 19.10.2020
 * Time: 15:53
 */

namespace core;


class Main
{
    private $params;
    public function main()
    {
        $this->params = require $_SERVER['DOCUMENT_ROOT'].'/configs/params.php';
        $selects = HtmlCreator::CreateSelect($this->params);
        require $_SERVER['DOCUMENT_ROOT'].'/layouts/layout.php';
    }
}