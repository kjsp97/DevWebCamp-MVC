<?php

namespace Controllers;

use Classes\Paginacion;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Model\Ponente;
use MVC\Router;

class PonentesController {
    
    public static function index(Router $router) {
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/ponentes?page=1');
        }
        
        $registros_por_pagina = 8;

        $total_registros = Ponente::total();

        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total_registros);

        //fin paginacion

        $ponentes = Ponente::paginar($registros_por_pagina, $paginacion->offset());
        
        if ($ponentes) {
            if ($pagina_actual > $paginacion->total_paginas()) {
                header('Location: /admin/ponentes?page=1');
            }
        }
        
        $router->render('admin/ponentes/index', [
            'titulo' => 'Panel de Ponentes',
            'ponentes' => $ponentes,
            'paginacion' => $paginacion->paginacion()
        ]);
    }
    
    public static function crear(Router $router) {
        $ponente = new Ponente;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!empty($_FILES['imagen']['tmp_name'])) {
                $carpeta_imagenes = 'img/speakers';
                if (!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0755, true);
                }

                $manager = new ImageManager(Driver::class);
                $imagen_png = $manager->read($_FILES['imagen']['tmp_name'])->cover(800, 800);
                $imagen_webp = $manager->read($_FILES['imagen']['tmp_name'])->cover(800, 800);

                $nombre_imagen = md5(uniqid(rand(), true));

                $_POST['imagen'] = $nombre_imagen;
            }

            $_POST['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);
            
            $ponente->sync($_POST);
            
            $errores = $ponente->validate();
            
            if (empty($errores)) {
                $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . '.png');
                $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . '.webp');
                $ponente->save();

                header('location: /admin/ponentes');
            }
        }

        
        $alertas = Ponente::getAlerts();
        $router->render('admin/ponentes/crear', [
            'titulo' => 'Registrar Ponente',
            'alertas' => $alertas,
            'ponente' => $ponente,
            'redes' => json_decode($ponente->redes)
        ]);
    }

    public static function editar(Router $router) {
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if (!$id) {
            header('Location: /admin/ponentes');
        }
        $ponente = Ponente::find($id);
        if (!$ponente) {
            header('Location: /admin/ponentes'); 
        }
        $ponente->imagen_actual = $ponente->imagen;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!empty($_FILES['imagen']['tmp_name'])) {
                $carpeta_imagenes = 'img/speakers';
                unlink($carpeta_imagenes . '/' . $ponente->imagen_actual . '.webp');
                unlink($carpeta_imagenes . '/' . $ponente->imagen_actual . '.png');

                if (!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0755, true);
                }

                $manager = new ImageManager(Driver::class);
                $imagen_png = $manager->read($_FILES['imagen']['tmp_name'])->cover(800, 800);
                $imagen_webp = $manager->read($_FILES['imagen']['tmp_name'])->cover(800, 800);

                $nombre_imagen = md5(uniqid(rand(), true));

                $_POST['imagen'] = $nombre_imagen;
            }else{
                $_POST['imagen'] = $ponente->imagen_actual;
            }

            $_POST['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);
            
            $ponente->sync($_POST);
            
            // debug($ponente);
            $errores = $ponente->validate();
            
            if (empty($errores)) {
                if (isset($nombre_imagen)) {
                    $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . '.png');
                    $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . '.webp');
                }
                $ponente->save();

                header('location: /admin/ponentes/editar');
            }
        }

        $alertas = Ponente::getAlerts();
        $router->render('admin/ponentes/editar', [
            'titulo' => 'Editar Ponente',
            'alertas' => $alertas,
            'ponente' => $ponente,
            'redes' => json_decode($ponente->redes)
        ]);
    }

    public static function eliminar() {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if (!$id) {
            header('Location: /admin/ponentes');
        }
        $ponente = Ponente::find($id);
        if (!$ponente) {
            header('Location: /admin/ponentes'); 
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            unlink('img/speakers/' . $ponente->imagen . '.webp');
            unlink('img/speakers/' . $ponente->imagen . '.png');
            $ponente->delete();
            header('Location: /admin/ponentes');
        }
    }
}