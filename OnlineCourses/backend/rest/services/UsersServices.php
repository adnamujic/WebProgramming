<?php
require_once __DIR__ . '/../dao/UsersDao.php';
require_once __DIR__ . '/BaseServices.php';

class UsersService extends BaseService {
    public function __construct() {
        parent::__construct(new UsersDao());
    }

    // Provjera da li email već postoji u bazi
    public function emailExists($email) {
        return $this->dao->getUserByEmail($email) !== null;
    }

    // Autentifikacija korisnika (login)
    public function authenticate($email, $password) {
        $user = $this->dao->getUserByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    // Registracija novog korisnika
    public function register($data) {
        if ($this->emailExists($data['email'])) {
            throw new Exception('Email already exists.');
        }
        // Hashiranje lozinke prije nego što je pohranimo
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        return $this->dao->add($data);
    }

    // Ažuriranje korisničkih podataka
    public function updateUser($id, $data) {
        // Ako korisnik mijenja lozinku, prvo je treba hashirati
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }
        return $this->dao->update($id, $data);
    }

    // Brisanje korisnika
    public function deleteUser($id) {
        return $this->dao->delete($id);
    }

    // Dohvat korisnika po ID-u
    public function getById($id) {
        return $this->dao->getById($id);
    }

    // Dohvat svih korisnika
    public function getAll() {
        return $this->dao->getAll();
    }
}
