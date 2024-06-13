<?php

require_once __DIR__ . "/../app/controllers/ErrorController.php";

// Identifier sur quelle page on est grace au param d'url "_url"
// if (isset($_GET['_url'])) {
//     $currentPage = $_GET['_url'];
// } else {
//     $currentPage = '/';
// }

// Version ternaire du if else ci-dessus → condition ? alors : sinon
// $currentPage = isset($_GET['_url']) ? $_GET['_url'] : '/';

// Version coalescence (version super Sayen :P)
$currentPage = $_GET['_url'] ?? '/';

// On liste les différentes routes de notre projet
$routes = [];

// On crée le router
if (isset($routes[$currentPage])) {
    // On appelle la bonne page (bonne méthode de bon controller)

    $controller = new $routes[$currentPage]['controller']();
    $method = $routes[$currentPage]['method'];

    // Le dispatcher
    $controller->$method();
} else {
    // Erreur 404
    $controller = new ErrorController();
    $controller->error404();
}
