<?php
/**
 * Created by PhpStorm.
 * User: Юра
 * Date: 18.10.2020
 * Time: 23:22
 */

namespace core;

use PDO;
class Model
{
    private $connect;
    private $params;

    public function __construct()
    {
        $db = require $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';
        $this->connect = new PDO('mysql:host=' . $db['host'] . ';dbname=' . $db['dbname'] . '', $db['user'], $db['password']);
        $check = $this->tableExists('`ships`');
        if (!$check) {
            $this->createTable();
            $this->fillData();
        }
    }

    public function selectShips($data,$sql)
    {
        $sth = $this->connect->prepare($sql);
        $sth->execute($data);
        $ships = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $ships;
    }

    private function fillData()
    {
        $data = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/configs/ships.json'),true);


        $sth = $this->connect->prepare("INSERT INTO `ships` SET `name` = :name, `type` = :type, `level` = :level, `date` = :date, `nation` = :nation,`price` = :price");
        foreach ($data as $key => $elem) {
            $sth->execute(array('name' => $elem['name'], 'type' => $elem['type'],'level' => $elem['level'],'date'=>$elem['date'],'nation'=>$elem['nation'],'price'=>$elem['price']));
        }
    }

    private function tableExists($table)
    {
        try {
            $sth = $this->connect->prepare("SELECT 1 FROM $table LIMIT 1");
            $sth->execute();
            $result = $sth->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return FALSE;
        }

        return $result !== FALSE;
    }

    private function createTable()
    {
        $table = $this->connect->prepare("CREATE TABLE `ships` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(32) NOT NULL , `nation` VARCHAR(32) NOT NULL , `type` VARCHAR(32) NOT NULL , `level` INT NOT NULL , `price` INT NOT NULL , `date` INT NOT NULL , PRIMARY KEY (`id`))");
        $table->execute();
    }
}