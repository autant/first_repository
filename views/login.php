<?php
// Inclure le fichier d'en-tête
require_once 'views/header.php';
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
