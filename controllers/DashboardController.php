<?php

namespace Controllers;

use Model\Evento;
use Model\Registro;
use Model\Usuario;
use MVC\Router;

class DashboardController {
    
    public static function index(Router $router) {

        $registros = Registro::get('5');
        foreach ($registros as $registro) {
            $registro->usuario = Usuario::find($registro->usuario_id);
        }
        $ingreso_presencial = Registro::total('paquete_id', '1');
        $ingreso_virtual = Registro::total('paquete_id', '2');

        $ingresos = ($ingreso_virtual * 46.98) + ($ingreso_presencial * 191.88);
        // Eventos
        $mas_disponibles = Evento::orderLimit('disponibles', 'DESC', '5');
        $menos_disponibles = Evento::orderLimit('disponibles', 'ASC', '5');
        $router->render('admin/dashboard/index', [
            'titulo' => 'Panel de Administración',
            'registros' => $registros,
            'ingresos' => $ingresos,
            'mas_disponibles' => $mas_disponibles,
            'menos_disponibles' => $menos_disponibles

        ]);
    }
}