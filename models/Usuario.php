<?php

namespace Model;

class Usuario extends ActiveRecord {
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'confirmado', 'token', 'admin'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $password2;
    public $confirmado;
    public $token;
    public $admin;

    public $password_actual;
    public $password_nuevo;

    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
        $this->token = $args['token'] ?? '';
        $this->admin = $args['admin'] ?? 0;
    }

    public function validateLogin() {
        if(!$this->email) {
            self::$alertas['error'][] = 'Introduce un correo electronico';
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL) && $this->email) {
            self::$alertas['error'][] = 'Correo electronico no válido';
        }
        if(!$this->password) {
            self::$alertas['error'][] = 'Introduce una contraseña';
        }
        return self::$alertas;

    }

    public function validateUser() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre es Obligatorio';
        }
        if(!$this->apellido) {
            self::$alertas['error'][] = 'El Apellido es Obligatorio';
        }
        if(!$this->email) {
            self::$alertas['error'][] = 'Correo electronico es Obligatorio';
        }
        if(!$this->password) {
            self::$alertas['error'][] = 'Contraseña no puede ir vacia';
        }
        if(strlen($this->password) < 6 && $this->password) {
            self::$alertas['error'][] = 'Contraseña min. 6 caracteres';
        }
        if($this->password !== $this->password2) {
            self::$alertas['error'][] = 'Las contraseñas son diferentes';
        }
        return self::$alertas;
    }

    public function validateEmail() {
        if(!$this->email) {
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL) && $this->email) {
            self::$alertas['error'][] = 'Email no válido';
        }
        return self::$alertas;
    }

    public function validatePassword() {
        if(!$this->password) {
            self::$alertas['error'][] = 'Contraseña no puede ir vacia';
        }
        if(strlen($this->password) < 6 && $this->password) {
            self::$alertas['error'][] = 'Contraseña min. 6 caracteres';
        }
        return self::$alertas;
    }

    public function newPassword() : array {
        if(!$this->password_actual) {
            self::$alertas['error'][] = 'Contraseña Actual no puede ir vacia';
        }
        if(!$this->password_nuevo) {
            self::$alertas['error'][] = 'Nueva contraseña no puede ir vacia';
        }
        if(strlen($this->password_nuevo) < 6) {
            self::$alertas['error'][] = 'Contraseña min. 6 caracteres';
        }
        return self::$alertas;
    }

    public function checkPassword() : bool {
        return password_verify($this->password_actual, $this->password );
    }

    public function hashPassword() : void {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function createToken() : void {
        $this->token = uniqid();
    }
}