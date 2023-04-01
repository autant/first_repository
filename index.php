<?php

require_once 'controllers/UserController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'login';

switch($action) {
    case 'login':
        // Afficher la page de connexion
        require_once 'views/login.php';
        break;
    case 'register':
        // Traitement de l'inscription
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupération des données du formulaire
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $pseudo = trim($_POST['pseudo']);
            $password = $_POST['password'];
            $firstname = trim($_POST['firstname']);
            $lastname = trim($_POST['lastname']);
            $ddn = $_POST['ddn'];
    
            $errors = [];
    
            // Validation de l'email
            if (!$email) {
                $errors[] = 'L\'adresse email est invalide';
            }
    
            // Validation du pseudo
            if (empty($pseudo)) {
                $errors[] = 'Le pseudo est obligatoire';
            }
    
            // Validation du mot de passe
            if (strlen($password) < 8) {
                $errors[] = 'Le mot de passe doit contenir au moins 8 caractères';
            }
    
            // Validation de la date de naissance
            $date = DateTime::createFromFormat('Y-m-d', $ddn);
            if (!$date || $date->format('Y-m-d') !== $ddn) {
                $errors[] = 'La date de naissance est invalide';
            }
    
            if (count($errors) === 0) {
                // Tous les champs sont valides, on peut créer le compte utilisateur
                $userController = new UserController();
                $userController->register($email, $pseudo, $password, $firstname, $lastname, $ddn);
            } else {
                // Affichage des erreurs
                require_once 'views/register.php';
            }
        } else {
            // Afficher la page d'enregistrement
            require_once 'views/register.php';
        }
        break;
    
    case 'logout':
        // Déconnexion de l'utilisateur
        session_start();
        session_unset();
        session_destroy();
        header('Location: index.php');
        break;
    default:
        // Afficher la page d'accueil
        require_once 'views/home.php';
        break;
}

