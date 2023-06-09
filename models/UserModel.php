<?php

require_once 'config/Database.php';

/**
 * Summary of UserModel
 */
class UserModel {

    private $db;
    private $email;
    private $pseudo;
    private $password;
    private $firstname;
    private $lastname;
    private $ddn;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPseudo($pseudo) {
        $this->pseudo = $pseudo;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    public function setDdn($ddn) {
        $this->ddn = $ddn;
    }

    public function createUser() {
        $query = "INSERT INTO utilisateur (email, pseudo, password, firstname, lastname, ddn) VALUES (:email, :pseudo, :password, :firstname, :lastname, :ddn)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':pseudo', $this->pseudo);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':firstname', $this->firstname);
        $stmt->bindParam(':lastname', $this->lastname);
        $stmt->bindParam(':ddn', $this->ddn);
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



