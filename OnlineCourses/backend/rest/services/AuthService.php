<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../dao/UsersDao.php';
require_once __DIR__ . '/../middleware/RequestValidationMiddleware.php';
require_once __DIR__ . '/../vendor/autoload.php';

use \Firebase\JWT\JWT;

class AuthService {

    public function register($data) {
        // Validacija potrebnih polja
        RequestValidationMiddleware::validate(['email', 'password', 'name'], $data);

        $dao = new UsersDao();

        // Provjeri da li korisnik već postoji
        if ($dao->getByEmail($data['email'])) {
            Flight::halt(409, "User already exists");
        }

        // Heširanje lozinke prije spremanja
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['role'] = 'user'; 

        // Ubacivanje korisnika u bazu
        $dao->insert($data);

        return ["message" => "Registration successful"];
    }

    public function login($data) {
        // Validacija potrebnih polja
        RequestValidationMiddleware::validate(['email', 'password'], $data);

        $dao = new UsersDao();
        $user = $dao->getByEmail($data['email']);

        // Provjera korisnika i lozinke
        if (!$user || !password_verify($data['password'], $user['password'])) {
            Flight::halt(401, "Invalid credentials");
        }

        // Payload za JWT token
        $payload = [
            "user" => [
                "id" => $user['userID'],
                "email" => $user['email'],
                "role" => $user['role']
            ],
            "iat" => time(),
            "exp" => time() + (60 * 60) 
        ];

        // Kreiranje JWT tokena
        $jwt = JWT::encode($payload, Config::JWT_SECRET(), 'HS256');

        return ["token" => $jwt];
    }
}
