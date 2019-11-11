<?php
namespace App;
use PDO;

class Shop extends EntidadBase
{
    protected $visible = [
        'id' => 'number',
        'mail_adress' => 'text',
        'password' => 'password',
        'adress' => 'text',
        'postalCode' => 'number',
        'country' => 'text'
    ];

    protected static $index = 'id';
    protected static $table = 'Shops';

    public static function checkLogin($email, $pass){
        $bd = new bd();
        $sth = $bd->prepare("SELECT id, mailAdress FROM Shops WHERE mailAdress LIKE :email AND password LIKE :pass");
        $resul = $sth->execute(['email' => $email,'pass' => $pass]);
        if($resul){
            return new Shop($sth->fetch(PDO::FETCH_OBJ)->id);
        }else{
            return FALSE;
        }
    }
}

