<form action="/register" method="POST">
<?php
require_once 'controllers/UserController.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action) {
    case 'login':
        // Afficher la page de connexion
        require_once 'views/login.php';
        break;
    case 'register':
        // Traitement de l'inscription
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
                $userController->register();
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
?>

    <label for="email">Adresse email</label>
    <input type="email" id="email" name="email" required>
    <br>
    <label for="pseudo">Pseudo</label>
    <input type="text" id="pseudo" name="pseudo" required>
    <br>
    <label for="password">Mot de passe</label>
    <input type="password" id="password" name="password" required>
    <br>
    <label for="firstname">Prénom</label>
    <input type="text" id="firstname" name="firstname" required>
    <br>
    <label for="lastname">Nom</label>
    <input type="text" id="lastname" name="lastname" required>
    <br>
    <label for="ddn">Date de naissance</label>
    <input type="date" id="ddn" name="ddn" required>
    <br>
    <button type="submit">S'inscrire</button>
</form>


