<?php

require_once 'config/Database.php';

class UserModel {

    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function createUser($email, $pseudo, $password, $firstname, $lastname, $ddn) {
        $query = "INSERT INTO utilisateur (email, pseudo, password, firstname, lastname, ddn) VALUES (:email, :pseudo, :password, :firstname, :lastname, :ddn)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':ddn', $ddn);
        return $stmt->execute();
    }

    public function getUserByPseudo($pseudo) {
        $query = "SELECT * FROM utilisateur WHERE pseudo = :pseudo";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
