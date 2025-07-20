<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class AuthController {
    public static function login(Router $router) {
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
            $usuario = new Usuario($_POST);

            $alertas = $usuario->validateLogin();
            
            if(empty($alertas)) {
                $usuario = Usuario::where('email', $usuario->email);
                if(!$usuario || !$usuario->confirmado ) {
                    Usuario::setAlert('error', 'Usuario no existente o no confirmado');
                } else {
                    if( password_verify($_POST['password'], $usuario->password) ) {
                        
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['apellido'] = $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['admin'] = $usuario->admin ?? null;

                        if ($_SESSION['admin']) {
                            header('location: /admin/dashboard');
                        }else{
                            header('location: /finalizar-registro');
                        }
                        
                    } else {
                        Usuario::setAlert('error', 'Contraseña Incorrecta');
                    }
                }
            }
        }

        $alertas = Usuario::getAlerts();
        
        $router->render('auth/login', [
            'titulo' => 'Iniciar Sesión',
            'alertas' => $alertas
        ]);
    }

    public static function logout() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_SESSION = [];
            header('Location: /');
        }
       
    }

    public static function registro(Router $router) {
        $alertas = [];
        $usuario = new Usuario;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $usuario->sync($_POST);
            
            $alertas = $usuario->validateUser();
            if(empty($alertas)) {
                $existeUsuario = Usuario::where('email', $usuario->email);
                
                if($existeUsuario) {
                    Usuario::setAlert('error', 'El Usuario ya esta registrado');
                    $alertas = Usuario::getAlerts();
                } else {
                    $usuario->hashPassword();
                    
                    unset($usuario->password2);
                    
                    $usuario->createToken();
                    
                    $resultado =  $usuario->save();

                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->sendConfirm();
                    

                    if($resultado) {
                        header('Location: /mensaje');
                    }
                }
            }
        }
        
        $router->render('auth/registro', [
            'titulo' => 'Crea tu cuenta en DevWebcamp',
            'usuario' => $usuario, 
            'alertas' => $alertas
        ]);
    }

    public static function olvide(Router $router) {
        $alertas = [];
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validateEmail();

            if(empty($alertas)) {
                $usuario = Usuario::where('email', $usuario->email);

                if($usuario && $usuario->confirmado) {

                    $usuario->createToken();
                    unset($usuario->password2);

                    $usuario->save();

                    $email = new Email( $usuario->email, $usuario->nombre, $usuario->token );
                    $email->sendInstructions();



                    $alertas['ok'][] = 'Hemos enviado las instrucciones a tu email';
                } else {
                 

                    $alertas['error'][] = 'Usuario no existente o no confirmado';
                }
            }
        }

        $router->render('auth/olvide', [
            'titulo' => 'Olvide mi Password',
            'alertas' => $alertas
        ]);
    }

    public static function restablecer(Router $router) {

        $token = s($_GET['token']);

        if(!$token) header('Location: /');

        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            header('Location: /');
        }


        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $usuario->sync($_POST);

            $alertas = $usuario->validatePassword();

            if(empty($alertas)) {
                $usuario->hashPassword();

                $usuario->token = null;

                $resultado = $usuario->save();

                if($resultado) {
                    header('Location: /');
                }
            }
        }

        $alertas = Usuario::getAlerts();
        
        $router->render('auth/restablecer', [
            'titulo' => 'Restablecer Contraseña',
            'alertas' => $alertas
        ]);
    }

    public static function mensaje(Router $router) {

        $router->render('auth/mensaje', [
            'titulo' => 'Cuenta Creada Exitosamente'
        ]);
    }

    public static function confirmar(Router $router) {
        
        $token = s($_GET['token']);

        if(!$token) header('Location: /');

        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            header('Location: /');
        } else {
            $usuario->confirmado = 1;
            $usuario->token = '';
            unset($usuario->password2);
            
            $usuario->save();

            Usuario::setAlert('ok', 'Cuenta Comprobada Correctamente');
        }

        $router->render('auth/confirmar', [
            'titulo' => 'Confirma tu cuenta DevWebcamp',
            'alertas' => Usuario::getAlerts()
        ]);
    }
}