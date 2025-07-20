<?php

namespace Controllers;

use Model\Ponente;

class APIPonente {
    
    public static function index() {
        if (!isset($_SESSION['admin'])) {
            echo json_encode([]);
            return;
        }
        
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        $ponente = Ponente::find($id) ?? [];

        echo json_encode($ponente);
    }
}