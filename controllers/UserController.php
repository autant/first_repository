<?php
require_once 'models/UserModel.php';

class UserController {

    public function register() {
        $error = '';
        if(isset($_POST['submit'])) {
            $email = trim($_POST['email']);
            $pseudo = trim($_POST['pseudo']);
            $password = trim($_POST['password']);
            $password_confirm = trim($_POST['password_confirm']);
            $firstname = trim($_POST['firstname']);
            $lastname = trim($_POST['lastname']);
            $ddn = trim($_POST['ddn']);
            // Vérification des champs obligatoires
            if(empty($email) || empty($pseudo) || empty($password) || empty($password_confirm)) {
                $error = 'Tous les champs obligatoires doivent être remplis.';
            }
            // Vérification de l'email
            else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'L\'adresse e-mail n\'est pas valide.';
            }
            // Vérification du pseudo
            else if (!preg_match("/^[a-zA-Z0-9]*$/",$pseudo)) {
                $error = 'Le pseudo ne doit contenir que des lettres et des chiffres.';
            }
            // Vérification du mot de passe
            else if ($password !== $password_confirm) {
                $error = 'Les mots de passe ne sont pas identiques.';
            }
            else {
                // Vérification si l'utilisateur existe déjà
                $userModel = new UserModel();
                $user = $userModel->getUserByPseudo($pseudo);
                if ($user !== false) {
                    $error = 'Ce pseudo est déjà utilisé.';
                } else {
                    // Création du nouvel utilisateur
                    $result = $userModel->createUser($email, $pseudo, password_hash($password, PASSWORD_DEFAULT), $firstname, $lastname, $ddn);
                    if($result) {
                        header('Location: index.php?action=login');
                        exit();
                    }
                    else {
                        $error = 'Une erreur est survenue lors de la création de l\'utilisateur.';
                    }
                }
            }
        }
        require_once 'views/user/register.php';
    }

}
