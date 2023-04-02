<?php

require_once 'models/UserModel.php';

class UserController {

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
            $userModel = new UserModel();
            $userModel->setEmail($_POST['email']);
            $userModel->setPseudo($_POST['pseudo']);
            $userModel->setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT));
            $userModel->setFirstname($_POST['firstname']);
            $userModel->setLastname($_POST['lastname']);
            $userModel->setDdn($_POST['ddn']);
            $userModel->createUser();

            header('Location: index.php');
        } else {
            require_once './views/register.php';
        }
    }
    public function getUserByUsername($username) {
        // Se connecter à la base de données
        $db = new PDO('mysql:host=localhost;dbname=pills', 'root', '');
    
        // Exécuter la requête SQL
        $stmt = $db->prepare('SELECT * FROM utilisateur WHERE pseudo = :username');
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_OBJ);
    
        // Renvoyer l'utilisateur correspondant ou null si l'utilisateur n'existe pas
        return $user ? $user : null;
    }
    
}
