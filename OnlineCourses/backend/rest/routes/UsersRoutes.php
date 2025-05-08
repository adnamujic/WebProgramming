<?php
require_once __DIR__ . '/../services/UsersServices.php';

// Dohvati sve korisnike
Flight::route('GET /users', function() {
    $service = new UserService();
    Flight::json($service->getAll());
});

// Dohvati korisnika po ID-u
Flight::route('GET /users/@id', function($id) {
    $service = new UserService();
    $user = $service->getById($id);
    Flight::json($user);
});

// Dodaj novog korisnika
Flight::route('POST /users', function() {
    $data = Flight::request()->data->getData();
    $service = new UserService();
    
    // Provjeri da li email već postoji
    if ($service->emailExists($data['email'])) {
        Flight::json(['error' => 'Email već postoji.'], 400);
        return;
    }

    $userId = $service->add($data);  // Dodaj korisnika
    Flight::json(['id' => $userId], 201);  // Vrati ID novog korisnika
});

// Ažuriraj korisnika
Flight::route('PUT /users/@id', function($id) {
    $data = Flight::request()->data->getData();
    $service = new UserService();
    $service->update($id, $data);
    Flight::json(['message' => 'Korisnik ažuriran.']);
});

// Obriši korisnika
Flight::route('DELETE /users/@id', function($id) {
    $service = new UserService();
    $service->delete($id);
    Flight::json(['message' => 'Korisnik obrisan.']);
});

// Provjeri da li email postoji
Flight::route('GET /users/emailExists/@email', function($email) {
    $service = new UserService();
    $emailExists = $service->emailExists($email);
    Flight::json(['emailExists' => $emailExists]);
});

// Autentifikacija korisnika (login)
Flight::route('POST /users/authenticate', function() {
    $data = Flight::request()->data->getData();
    $service = new UserService();
    $authUser = $service->authenticate($data['email'], $data['password']);
    
    if ($authUser) {
        Flight::json(['message' => 'Uspješna prijava', 'user' => $authUser]);
    } else {
        Flight::json(['error' => 'Neuspješna prijava'], 401);
    }
});
?>
