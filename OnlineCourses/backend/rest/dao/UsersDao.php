<?php
require_once 'BaseDao.php';

class UsersDao extends BaseDao {
    public function __construct() {
        parent::__construct("Users", "userID");
    }

    // Dohvati korisnika po emailu
    public function getByEmail($email) {
        $stmt = $this->connection->prepare("SELECT * FROM Users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Provjeri da li email postoji
    public function emailExists($email) {
        $stmt = $this->connection->prepare("SELECT COUNT(*) FROM Users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    //"Login" metoda – provjera email + password 
    public function authenticate($email, $password) {
        $stmt = $this->connection->prepare("SELECT * FROM Users WHERE email = :email AND password = :password");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        return $stmt->fetch();
    }
}
?>
