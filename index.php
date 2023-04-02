<?php

require_once './controllers/UserController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'login';

switch($action) {
    case 'login':
        // Afficher la page de connexion
        require_once './views/login.php';
        break;
    case 'register':
        // Afficher la page d'inscription
        require_once './views/register.php';
        break;
    case 'logout':
        // Déconnexion de l'utilisateur
        session_start();
        session_unset();
        session_destroy();
        header('Location: index.php');
        break;
    case 'home':
        // Vérification de l'authentification de l'utilisateur
        session_start();
        if (isset($_SESSION['user_id'])) {
            // L'utilisateur est authentifié, on peut afficher la page d'accueil
            require_once './views/home.php';
        } else {
            // L'utilisateur n'est pas authentifié, on redirige vers la page de connexion
            header('Location: index.php?action=login');
        }
        break;
    default:
        // Vérification de l'authentification de l'utilisateur
        session_start();
        if (isset($_SESSION['user_id'])) {
            // L'utilisateur est authentifié, on redirige vers la page d'accueil
            header('Location: index.php?action=home');
        } else {
            // L'utilisateur n'est pas authentifié, on redirige vers la page de connexion
            header('Location: index.php?action=login');
        }
        break;
}
