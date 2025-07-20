<?php

function debug($variable) {
    echo "<pre>";
    print_r($variable);
    echo "</pre>";
    // exit;
}

function debugvr($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function hideAlerts() {
    echo '<script>window.onload=function(){let e=document.querySelectorAll(".alerta");setTimeout(()=>{e.forEach(l=>l.style.display="none")},3e3)};</script>';
}

function lastOne(string $actual, string $ultimo) : bool {
    if ($actual !== $ultimo) {
        return true;
    }
    return false;
}

function currentPath($path){
    return str_contains($_SERVER['PATH_INFO'] ?? '/', $path) ? true : false;
}
