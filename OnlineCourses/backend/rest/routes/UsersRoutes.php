<?php
require_once __DIR__ . '/../services/UsersServices.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';

// Dohvati sve korisnike - zahtijeva 'read' dozvolu (samo admin će imati)
Flight::route('GET /users', function() {
    AuthMiddleware::verifyTokenFromHeader();
    AuthMiddleware::authorizePermission('read');

    $service = new UserService();
    Flight::json($service->getAll());
});

// Dohvati korisnika po ID-u - admin ili vlasnik profila
Flight::route('GET /users/@id', function($id) {
    AuthMiddleware::verifyTokenFromHeader();
    $user = Flight::get('user');

    if ($user->id != $id && !in_array('read', $user->permissions)) {
        Flight::halt(403, 'Access denied');
    }

    $service = new UserService();
    $userData = $service->getById($id);
    Flight::json($userData);
});

// Registracija novog korisnika - otvorena ruta
Flight::route('POST /users/register', function() {
    $data = Flight::request()->data->getData();
    $service = new UserService();

    if ($service->emailExists($data['email'])) {
        Flight::json(['error' => 'Email već postoji.'], 400);
        return;
    }

    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    $userId = $service->add($data);
    Flight::json(['id' => $userId], 201);
});

// Login - otvorena ruta
Flight::route('POST /users/login', function() {
    $data = Flight::request()->data->getData();
    $service = new UserService();
    $user = $service->getByEmail($data['email']);

    if (!$user || !password_verify($data['password'], $user['password'])) {
        Flight::halt(401, 'Neuspješna prijava');
    }

    // Dohvati dozvole iz rolesPermissions (opcionalno: iz DB)
    require_once __DIR__ . '/../data/rolesPermissions.php';
    $role = $user['role'] ?? 'user';
    $permissions = $rolesPermissions[$role] ?? [];

    $payload = [
        "user" => [
            "id" => $user['userID'],
            "email" => $user['email'],
            "role" => $role,
            "permissions" => $permissions
        ],
        "iat" => time(),
        "exp" => time() + (60 * 60)
    ];

    $jwt = \Firebase\JWT\JWT::encode($payload, Config::JWT_SECRET(), 'HS256');

    Flight::json(['token' => $jwt]);
});

// Ažuriraj korisnika - vlasnik profila ili admin (ko ima 'update')
Flight::route('PUT /users/@id', function($id) {
    AuthMiddleware::verifyTokenFromHeader();
    $user = Flight::get('user');

    if ($user->id != $id && !in_array('update', $user->permissions)) {
        Flight::halt(403, 'Access denied');
    }

    $data = Flight::request()->data->getData();
    $service = new UserService();
    $service->update($id, $data);
    Flight::json(['message' => 'Korisnik ažuriran.']);
});

// Obriši korisnika - zahtijeva 'delete' dozvolu
Flight::route('DELETE /users/@id', function($id) {
    AuthMiddleware::verifyTokenFromHeader();
    AuthMiddleware::authorizePermission('delete');

    $service = new UserService();
    $service->delete($id);
    Flight::json(['message' => 'Korisnik obrisan.']);
});

// Provjera emaila - otvoreno
Flight::route('GET /users/emailExists/@email', function($email) {
    $service = new UserService();
    $emailExists = $service->emailExists($email);
    Flight::json(['emailExists' => $emailExists]);
});
