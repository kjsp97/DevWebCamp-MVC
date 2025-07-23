<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Paquete;
use Model\Registro;
use Model\Usuario;
use MVC\Router;

class RegistradosController {
    
    public static function index(Router $router) {
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/registrados?page=1');
        }
        
        $registros_por_pagina = 8;

        $total_registros = Registro::total();

        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total_registros);

        //fin paginacion

        $registros = Registro::paginar($registros_por_pagina, $paginacion->offset());
        foreach ($registros as $registro) {
            $registro->paquete = Paquete::find($registro->paquete_id);
            $registro->usuario = Usuario::find($registro->usuario_id);
        }
        
        if ($registros) {
            if ($pagina_actual > $paginacion->total_paginas()) {
                header('Location: /admin/registrados?page=1');
            }
        }
        
        $router->render('admin/registrados/index', [
            'titulo' => 'Panel de Registrados',
            'registros' => $registros,
            'paginacion' => $paginacion->paginacion()
        ]);
    }
}