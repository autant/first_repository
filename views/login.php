<?php
// Inclure le fichier d'en-tête
require_once 'views/header.php';

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données de connexion du formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérifier si l'utilisateur existe dans la base de données
    $userController = new UserController();
    $user = $userController->getUserByUsername($username);

    if ($user && password_verify($password, $user->password)) {
        // L'utilisateur existe et le mot de passe est correct, connecter l'utilisateur en créant une variable de session
        session_start();
        $_SESSION['user_id'] = $user->id;

        // Rediriger l'utilisateur vers la page d'accueil
        header('Location: index.php?action=home');
        exit;
    } else {
        // Le nom d'utilisateur ou le mot de passe est incorrect, afficher un message d'erreur
        $errorMessage = 'Nom d\'utilisateur ou mot de passe incorrect';
    }
}
?>

<h1>Page de connexion</h1>

<?php
// Afficher un message d'erreur s'il y en a un
if (isset($errorMessage)) {
    echo '<p class="error">' . $errorMessage . '</p>';
}
?>
<!-- Formulaire de connexion -->
<h2>Connexion</h2>
<form action="index.php?action=login" method="POST">
    <label for="username">Nom d'utilisateur :</label>
    <input type="text" id="username" name="username"><br>
    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password"><br>
    <input type="submit" value="Se connecter">
</form>

<p>Pas encore inscrit ? <a href="index.php?action=register">Inscrivez-vous ici</a>.</p>
<?php
// Inclure le fichier de pied de page
require_once 'views/footer.php';
?>
