<?php
require_once 'controllers/UserController.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action) {
    case 'login':
        // Afficher la page de connexion
        require_once 'views/user/login.php';
        break;
    case 'register':
        require_once 'views/register.php';
        // Afficher la page d'enregistrement
        $userController = new UserController();
        $userController->register();
        break;
    case 'logout':
        // Déconnexion de l'utilisateur
        session_start();
        session_unset();
        session_destroy();
        header('Location: index.php');
        break;
//    default:
//        // Afficher la page d'accueil
//        require_once 'views/home.php';
//        break;
}
