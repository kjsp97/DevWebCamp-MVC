<?php
namespace Model;
class ActiveRecord {

    protected static $db;
    protected static $tabla = '';
    protected static $columnasDB = [];

    protected static $alertas = [];
    
    public static function setDB($database) {
        self::$db = $database;
    }

    public static function setAlert($tipo, $mensaje) {
        static::$alertas[$tipo][] = $mensaje;
    }

    public static function getAlerts() {
        return static::$alertas;
    }

    public function check() {
        static::$alertas = [];
        return static::$alertas;
    }

    public static function querySQL($query) {
        $resultado = self::$db->query($query);

        $array = [];
        while($row = $resultado->fetch_assoc()) {
            $array[] = static::createObject($row);
        }

        $resultado->free();

        return $array;
    }

    protected static function createObject($row) {
        $objeto = new static;

        foreach($row as $key => $value ) {
            if(property_exists( $objeto, $key  )) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    public function property() {
        $propiedades = [];
        foreach(static::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $propiedades[$columna] = $this->$columna;
        }
        return $propiedades;
    }

    public function sanitizePoperty() {
        $propiedades = $this->property();
        $sanitizado = [];
        foreach($propiedades as $key => $value ) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    public function sync($args=[]) { 
        foreach($args as $key => $value) {
          if(property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
          }
        }
    }

    public function save() {
        $resultado = '';
        if(!is_null($this->id)) {
            $resultado = $this->update();
        } else {
            $resultado = $this->create();
        }
        return $resultado;
    }

    public static function all($orden = 'DESC') {
        $query = "SELECT * FROM " . static::$tabla . " ORDER BY id {$orden}";
        $resultado = self::querySQL($query);
        return $resultado;
    }

    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE id = {$id}";
        $resultado = self::querySQL($query);
        return array_shift( $resultado ) ;
    }

    public static function order($columna, $orden) {
        $query = "SELECT * FROM " . static::$tabla  ." ORDER BY {$columna} {$orden} ";
        $resultado = self::querySQL($query);
        return $resultado;
    }

    public static function orderLimit($columna, $orden, $limite) {
        $query = "SELECT * FROM " . static::$tabla  ." ORDER BY {$columna} {$orden} LIMIT {$limite}";
        $resultado = self::querySQL($query);
        return $resultado;
    }

    public static function where($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE {$columna} = '{$valor}' ";
        $resultado = self::querySQL($query);
//         debug($resultado);
// exit;
        return array_shift( $resultado ) ;
    }
    
    public static function whereArray($array = []) {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE ";
        foreach ($array as $key => $value) {
            if ($key == array_key_last($array)) {
                $query .= "{$key} = '{$value}'";
            }else {
                $query .= "{$key} = '{$value}' AND ";
            }
        }
        $resultado = self::querySQL($query);
        return $resultado;
    }

    public static function belongsTo($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE {$columna} = '{$valor}' ";
        $resultado = self::querySQL($query);
        return $resultado;
    }
    //paginacion
    public static function total($tabla = '', $valor = '') {
        $query = "SELECT COUNT(*) FROM " . static::$tabla;
        if ($tabla) {
            $query .= " WHERE {$tabla} = '{$valor}'";
        }
        $resultado = self::$db->query($query)->fetch_array();
        return array_shift($resultado);
    }

    public static function paginar($limite_paginacion, $offset) {
        $query = "SELECT * FROM " . static::$tabla . " ORDER BY id DESC LIMIT {$limite_paginacion} OFFSET {$offset}";
        $resultado = self::querySQL($query);
        return $resultado;
    }
    //final paginacion

    public static function totalArray($array = []) {
        $query = "SELECT COUNT(*) FROM " . static::$tabla  ." WHERE ";
        foreach ($array as $key => $value) {
            if ($key == array_key_last($array)) {
                $query .= "{$key} = '{$value}'";
            }else {
                $query .= "{$key} = '{$value}' AND ";
            }
        }

        $resultado = self::$db->query($query)->fetch_array();
        return array_shift($resultado);
    }

    public static function SQL($query) {
        $resultado = self::querySQL($query);
        return $resultado;
    }

    public static function get($limite) {
        $query = "SELECT * FROM " . static::$tabla . " ORDER BY id DESC LIMIT {$limite}";
        $resultado = self::querySQL($query);
        return $resultado;
    }

    public function create() {
        $propiedades = $this->sanitizePoperty();
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($propiedades));
        $query .= " ) VALUES ('"; 
        $query .= join("', '", array_values($propiedades));
        $query .= "') ";

        try {
            $resultado = self::$db->query($query);
            return [
               'resultado' =>  $resultado,
               'id' => self::$db->insert_id
            ];
        } catch (\mysqli_sql_exception $e) {
            return [
                'resultado' => false,
                'error' => $e->getMessage()
             ];
        }
    }

    public function update() {
        $propiedades = $this->sanitizePoperty();

        $valores = [];
        foreach($propiedades as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . static::$tabla ." SET ";
        $query .=  join(', ', $valores );
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 "; 

        $resultado = self::$db->query($query);
        return $resultado;
    }

    public function delete() {
        $query = "DELETE FROM "  . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        return $resultado;
    }

}