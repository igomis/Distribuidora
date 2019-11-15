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
            return true;
        }catch (PDOException $e) {
            echo 'Falló la consulta: ' . $e->getMessage();
            return false;
        }catch (\Exception $e) {
            echo $e->getMessage();
            return false;
        }

    }

    // Funcions de consultes genèriques

    public static function getAll($fetch_style=PDO::FETCH_OBJ)
    {
        $bd = new bd();
        return $bd->query("SELECT * FROM ".static::$table)->fetchAll($fetch_style);
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

            $stmt->execute(['id'=>$id]);
            if(!$stmt->rowCount()) throw new \Exception('Error:'.$stmt->errorInfo()[2]);
            echo 'Element Esborrat';
            return true;

        }catch (PDOException $e) {
            echo 'Falló la consulta: ' . $e->getMessage();
            return false;
        }catch (\Exception $e) {
            echo $e->getMessage();
            return false;
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

    public static function response($method){
        $class = get_called_class();
        switch ($method) {
            case 'GET':
                if (isset($_GET['id']))
                    $elements = static::getbyId($_GET['id']);
                else
                    $elements = static::getAll();
                if ($elements) {
                    http_response_code(200);
                    echo json_encode($elements);
                    exit();
                }
                http_response_code(404);
                return json_encode(array("message" => "No products found."));
                break;
            case 'POST':
                $data = json_decode(file_get_contents("php://input"), true);
                $element = new $class($data);

                if ($element->save()) {
                    http_response_code(200);
                    echo json_encode($element->id);
                    exit();
                }
                http_response_code(404);
                return json_encode(array("message" => "No Inserit"));
                break;
            case 'PUT';
                $data = json_decode(file_get_contents("php://input"), true);
                $element = new $class($_GET['id']);
                foreach ($data as $key => $value) {
                    $element->$key = $value;
                }

                if ($element->save()) {
                    http_response_code(200);
                    echo json_encode($element->id, true);
                    exit();
                }
                http_response_code(404);
                return json_encode(array("message" => "No Inserit"));
                break;
            case 'DELETE':
                if (isset($_GET['id'])) {
                    $result = static::deletebyId($_GET['id']);
                    if ($result) {
                        http_response_code(200);
                        echo json_encode(array("message" => "Esborrat satisfactori."));
                        exit();
                    }
                }
                http_response_code(404);
                return json_encode(array("message" => "No products found."));
                break;
        }
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
