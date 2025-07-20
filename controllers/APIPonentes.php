<?php

namespace Controllers;

use Model\Ponente;

class APIPonentes {
    public static function index() {
        if (!isset($_SESSION['admin'])) {
            echo json_encode([]);
            return;
        }
    
        $ponentes = Ponente::all() ?? [];

        echo json_encode($ponentes);
    }
}