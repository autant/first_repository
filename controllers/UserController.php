<?php
require_once 'models/UserModel.php';

class UserController {

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
            // Traitement de l'inscription
        } else {
            require_once 'views/user/register.php';
        }
    }
    

}
