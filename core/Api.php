<?php
/**
 * Created by PhpStorm.
 * User: Юра
 * Date: 19.10.2020
 * Time: 15:53
 */

namespace core;

class Api
{
    public $params;
    public $model;
    public $config;
    public $configSelect;
    public $lang;

    public function __construct()
    {
        $this->model = new Model();
        $this->config = require $_SERVER['DOCUMENT_ROOT'].'/configs/fields.php';
        $this->params = $_GET;
        $this->configSelect = require $_SERVER['DOCUMENT_ROOT'].'/configs/params.php';
        $this->lang =  locale_accept_from_http($_SERVER['HTTP_ACCEPT_LANGUAGE']);
    }

    public function main()
    {
        foreach ($this->config as $key =>$value) {
            $result[$key] = $this->getResult($key,$value);
        }
        $unitResult = Helper::concut($result['input'],$result['select']);
        $langResult = Helper::prepareResult($unitResult,$this->configSelect,$this->config['select']);
        $newResult['lang'] = $this->lang;
        $newResult['values'] = Helper::changeMoney($langResult,$this->lang,'price');
        echo json_encode($newResult);
    }

    private function getResult($type,$fields)
    {
        $dataToSql = Helper::prepareArray($this->params,$fields,$type);
        if ($dataToSql) {
            $sql = Helper::prepareSql($dataToSql);
            if ($type == 'input') {
                $dataToSql = array($dataToSql['name']);
            }
            $result =  $this->model->selectShips($dataToSql,$sql);
            return $result;
        } else {
            return false;
        }

    }

}