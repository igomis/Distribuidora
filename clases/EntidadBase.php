<?php

namespace App;
use \PDO;
use App\bd;

abstract class EntidadBase
{

    protected static $table;
    protected static $index;
    protected $attributes = [];
    protected $visible = [];


    public function __construct($items=[])
    {
        if (is_array($items))
            $this->attributes = array_intersect_key($items,$this->visible);
        else
            $this->find($items);
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->attributes)) {
            return ($this->attributes[$name]);
        }
    }

    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    public function __isset($name)
    {
        return isset($this->attributes[$name]);
    }

    public function find($id,$fetch_style=PDO::FETCH_ASSOC)
    {
        $this->attributes = self::getbyId($id,$fetch_style);
    }

    public function delete()
    {
        $id = $this->attributes[static::$index];
        self::deletebyId($id);
        $this->attributes = [];

    }


    public function save()
    {
        try {
            $bd = new bd();
            if (isset($this->attributes[static::$index]))
                $stmt = $bd->prepare($this->updateString());
            else
                $stmt = $bd->prepare($this->insertString());
            if(!$stmt->execute($this->attributes)) throw new \Exception('Error:'.$stmt->errorInfo()[2]);
            echo 'Element Inserit/modificat';
        }catch (PDOException $e) {
            echo 'Falló la consulta: ' . $e->getMessage();
        }catch (\Exception $e) {
            echo $e->getMessage();
        }

    }

    // Funcions de consultes genèriques

    public static function getAll()
    {
        $bd = new bd();
        return $bd->query("SELECT * FROM ".static::$table)->fetchAll(PDO::FETCH_OBJ);
    }

    public static function getbyId($id,$fetch_style=PDO::FETCH_OBJ)
    {
        try {
            $bd = new bd();
            $stmt = $bd->prepare("SELECT * FROM ". static::$table ." WHERE ".static::$index." = :id");
            if ($stmt->execute(['id'=>$id])) return $stmt->fetch($fetch_style);

            else throw new \Exception("Element no trobat");
        } catch (PDOException $e) {
            echo 'Falló la consulta: ' . $e->getMessage();
        }catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public static function getbyColum($columna, $valor)
    {
        $bd = new bd();
        return $bd->query("SELECT * FROM ". static::$table ." WHERE $columna = '$valor'")->fetchAll(PDO::FETCH_OBJ);
    }

    public static function deletebyId($id)
    {
        try {
            $bd = new bd();
            $stmt = $bd->prepare("DELETE FROM ".static::$table." WHERE ".static::$index. " = :id");

            if(!$stmt->execute(['id'=>$id])) throw new \Exception('Error:'.$stmt->errorInfo()[2]);
            echo 'Element Esborrat';

        }catch (PDOException $e) {
            echo 'Falló la consulta: ' . $e->getMessage();
        }catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public static function deleteAll($id)
    {
        $bd = new bd();
        return $bd->query("DELETE FROM ".static::$table);
    }

    public static function deleteByColum($columna, $valor)
    {
        $bd = new bd();
        return $bd->query("DELETE FROM ".static::$table." WHERE $columna = '$valor'");
    }



    private function insertString() : string
    {
        $columns = implode(', ', array_keys($this->attributes));

        $values = ":".implode(",:", array_keys($this->attributes));

        return "INSERT INTO ".static::$table."($columns) VALUES ($values)";
    }

    private function updateString() : string
    {

        $sql = "";
        foreach (array_keys($this->attributes) as $key )
            $sql .= "$key = :$key,";

        return "UPDATE ". static::$table." SET ".trim($sql,',')." WHERE ". static::$index. " = :".static::$index;
    }
}
