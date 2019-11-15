<?php
/**
 * Created by PhpStorm.
 * User: igomis
 * Date: 2019-07-17
 * Time: 12:58
 */

namespace App;

class bd extends \PDO
{

    public function __construct()
    {
        $res = $this->leer_config();
        try {
            return parent::__construct($res[0], $res[1], $res[2]);
        }catch (\PDOException $e){
            echo "Error amb la connexió a la base de dades: ".$e->getMessage();
            exit();
        }

    }

    private function leer_config(){
        $config = require $_SERVER['DOCUMENT_ROOT'].'/../config/database.php';
        if (!$config){
            throw new InvalidArgumentException("Revise fichero de configuración");
        }
        $resul = [];
        $resul[] = sprintf("mysql:dbname=%s;host=%s", $config['nom'], $config['ip']);
        $resul[] = $config['usuari'];
        $resul[] = $config['clau'];
        return $resul;
    }

}