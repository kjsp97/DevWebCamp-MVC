<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Categoria;
use Model\Dia;
use Model\Evento;
use Model\Hora;
use Model\Ponente;
use MVC\Router;

class EventosController {
    
    public static function index(Router $router) {
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/eventos?page=1');
        }

        $registros_por_pagina = 8;
        $total_eventos = Evento::total();
        $paginar = new Paginacion($pagina_actual, $registros_por_pagina, $total_eventos);
        $eventos = Evento::paginar($registros_por_pagina, $paginar->offset());

        foreach ($eventos as $evento) {
            $evento->categoria = Categoria::find($evento->categoria_id);
            $evento->dia = Dia::find($evento->dia_id);
            $evento->hora = Hora::find($evento->hora_id);
            $evento->ponente = Ponente::find($evento->ponente_id);
        }

        if ($eventos) {
            if ($pagina_actual > $paginar->total_paginas()) {
                    header('Location: /admin/eventos?page=1');
            }
        }
        

        $alertas = [];
        $router->render('admin/eventos/index', [
            'titulo' => 'Panel de Eventos',
            'alertas' => $alertas,
            'eventos' => $eventos,
            'paginacion' => $paginar->paginacion()
        ]);
    }

    public static function crear(Router $router) {
        $categorias = Categoria::all('ASC');
        $dias = Dia::all('ASC');
        $horas = Hora::all('ASC');
        $evento = new Evento;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $evento->sync($_POST);
            $errores = $evento->validate();
            if (empty($errores)) {
                $evento->save();
                header('Location: /admin/eventos');
            }
        }
        
        $alertas = Evento::getAlerts();
        $router->render('admin/eventos/crear', [
            'titulo' => 'Registrar eventos',
            'categorias' => $categorias,
            'dias' => $dias,
            'horas' => $horas,
            'evento' => $evento,
            'alertas' => $alertas
        ]);
    }

    public static function editar(Router $router) {
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            header('Location: /admin/eventos');
        }

        $evento = Evento::find($id);
        $categorias = Categoria::all('ASC');
        $dias = Dia::all('ASC');
        $horas = Hora::all('ASC');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // debug($evento);
            $evento->sync($_POST);
            $errores = $evento->validate();
            if (empty($errores)) {
                $evento->save();
                header('Location: /admin/eventos');
            }
        }
        
        $alertas = Evento::getAlerts();
        $router->render('admin/eventos/editar', [
            'titulo' => 'Editar eventos',
            'categorias' => $categorias,
            'dias' => $dias,
            'horas' => $horas,
            'evento' => $evento,
            'alertas' => $alertas
        ]);
    }

    public static function eliminar() {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if (!$id) {
            header('Location: /admin/eventos');
        }
        $evento = Evento::find($id);
        if (!$evento) {
            header('Location: /admin/eventos'); 
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $evento->delete();
            header('Location: /admin/eventos');
        }
    }  
}