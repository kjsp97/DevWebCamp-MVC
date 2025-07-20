<?php

namespace Controllers;

use Model\Categoria;
use Model\Dia;
use Model\Evento;
use Model\Hora;
use Model\Ponente;
use MVC\Router;

class PaginasController {
    
    public static function index(Router $router) {
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

        $ponentes_totales = Ponente::total();
        $conferencias_totales = Evento::total('categoria_id', 1);
        $workshops_totales = Evento::total('categoria_id', 2);

        $ponentes = Ponente::all();

        $router->render('paginas/index', [
            'titulo' => 'Inicio',
            'ponentes_totales' => $ponentes_totales,
            'conferencias_totales' => $conferencias_totales,
            'workshops_totales' => $workshops_totales,
            'eventos' => $eventos_formateados,
            'ponentes' => $ponentes
        ]);
    }

    public static function evento(Router $router) {
        $router->render('paginas/devwebcamp', [
            'titulo' => 'Sobre DevWebCamp'
        ]);
    }

    public static function paquetes(Router $router) {
        $router->render('paginas/paquetes', [
            'titulo' => 'Paquetes DevWebCamp'
        ]);
    }

    public static function conferencias(Router $router) {
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

        $router->render('paginas/conferencias', [
            'titulo' => 'Conferencias',
            'eventos' => $eventos_formateados
        ]);
    }
}