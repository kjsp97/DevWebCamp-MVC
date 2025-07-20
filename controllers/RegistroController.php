<?php

namespace Controllers;

use Model\Paquete;
use Model\Registro;
use Model\Usuario;
use Model\Categoria;
use Model\Evento;
use Model\Dia;
use Model\EventosRegistros;
use Model\Hora;
use Model\Ponente;
use Model\Regalo;
use MVC\Router;

class RegistroController {
    
    public static function crear(Router $router) {
        if (!$_SESSION['nombre']) {
            header('Location: /');
            return;
        }

        $id = $_SESSION['id'];
        $registrado = Registro::where('usuario_id', $id);
        if (!empty($registrado) && $registrado->paquete_id === '3') {
            header("Location: /entrada?id={$registrado->token}");
            return;
        }
        if (isset($registrado->regalo_id)) {
            header("Location: /entrada?id={$registrado->token}");
            return;
        }

        $router->render('registro/crear', [
            'titulo' => 'Eligen tu Plan'
        ]);
    }

    public static function gratis() {
        if (!$_SESSION['nombre']) {
            header('Location: /');
            return;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $token = substr(md5(uniqid(rand(), true)), 0,8);

            $registro = new Registro([
                'paquete_id' => 3,
                'pago_id' => '',
                'token' => $token,
                'usuario_id' => $_SESSION['id']
            ]);

            $registro->save();

            header("Location: /entrada?id={$token}");
            return;
        }
    }

    public static function entrada(Router $router) {

        $id = $_GET['id'];
        if (!$id || !strlen($id) === 8 || !$_SESSION['nombre']) {
            header('Location: /');
            return;
        }

        $registro = Registro::where('token', $id);
        if (!$registro) {
            header('Location: /');
            return;
        }

        if ($registro->regalo_id === '1' && $registro->paquete_id == '1') {
            header("Location: /finalizar-registro/conferencias");
            return;
        }
        
        $registro->paquete = Paquete::where('id', $registro->paquete_id);
        $registro->usuario = Usuario::where('id', $registro->usuario_id);

        
        $router->render('registro/entrada', [
            'titulo' => 'Asistencia a DevWebCamp',
            'registro' => $registro
        ]);
    }

    public static function pagar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!$_SESSION['nombre']) {
                header('Location: /');
                return;
            }

            if (empty($_POST)) {
                echo json_encode([]);
                return;
            }
        
            $datos = $_POST;
            $datos['token'] = substr(md5(uniqid(rand(), true)), 0,8);
            $datos['usuario_id'] = $_SESSION['id'];
            
            try {
                $registro = new Registro($datos);
                $resultado = $registro->save();
                echo json_encode($resultado);
            } catch (\Throwable $th) {
                echo json_encode([
                    'resultado' => 'error'
                ]);
            }
        }
    }

    public static function conferencias(Router $router) {
        if (!$_SESSION['nombre']) {
            header('Location: /');
            return;
        }
        
        $id = $_SESSION['id'];
        $registrado = Registro::where('usuario_id', $id);

        if ($registrado->paquete_id == '2') {
            header("Location: /entrada?id={$registrado->token}");
            return;
        }

        if (!$registrado || $registrado->paquete_id !== '1') {
            header("Location: /");
            return;
        }


        
        $eventos = Evento::order('hora_id', 'ASC');
        $eventos_formateados = [];


        foreach ($eventos as $evento) {
            $evento->categoria = Categoria::find($evento->categoria_id);
            $evento->dia = Dia::find($evento->dia_id);
            $evento->hora = Hora::find($evento->hora_id);
            $evento->ponente = Ponente::find($evento->ponente_id);

            if ($evento->dia_id === '1' && $evento->categoria_id === '1') {
                $eventos_formateados['conferencias_v'][] = $evento;
            }
            if ($evento->dia_id === '2' && $evento->categoria_id === '1') {
                $eventos_formateados['conferencias_s'][] = $evento;
            }
            if ($evento->dia_id === '1' && $evento->categoria_id === '2') {
                $eventos_formateados['workshops_v'][] = $evento;
            }
            if ($evento->dia_id === '2' && $evento->categoria_id === '2') {
                $eventos_formateados['workshops_s'][] = $evento;
            }
        }

        $regalos = Regalo::all('ASC');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!$_SESSION['nombre']) {
                header('Location: /');
                return;
            }


            $eventos = explode(',', $_POST['eventos']);
            if (empty($eventos)) {
                echo json_encode(['resultado' => false]);
                return;
            }
            $registro = Registro::where('usuario_id', $_SESSION['id']);
            if (!isset($registro) || $registro->paquete_id !== '1') {
                echo json_encode(['resultado' => false]);
                return;
            }

            $registro->regalo_id = $_POST['regalo'];

            $eventos_array = [];
            foreach ($eventos as $evento_id) {
                $evento = Evento::find($evento_id);
                if (!isset($evento) || $evento->disponibles === '0') {
                    echo json_encode(['resultado' => false]);
                    return;
                }
                $eventos_array[] = $evento;

            }

            foreach ($eventos_array as $evento) {
                $evento->disponibles -= 1;
                $evento->save();
                $args = [
                    'registro_id' => $registro->id,
                    'evento_id' => $evento->id
                ];
                $evento_registro = new EventosRegistros($args);
                $evento_registro->save();
            }

            $resultado = $registro->save();
            
            if ($resultado) {
                echo json_encode([
                    'resultado' => true,
                    'token' => $registro->token
                ]);
                return;
            }
        }

        $router->render('registro/conferencias', [
            'titulo' => 'Conferencias & Workshops',
            'eventos' => $eventos_formateados,
            'regalos' => $regalos
        ]);
    }
}