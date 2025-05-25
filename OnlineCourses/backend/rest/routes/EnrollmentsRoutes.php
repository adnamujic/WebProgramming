<?php
require_once __DIR__ . '/../services/EnrollmentsServices.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';

// Dohvati sve upise - zahtijeva autentifikaciju i 'read' dozvolu
Flight::route('GET /enrollments', function() {
    AuthMiddleware::verifyTokenFromHeader();
    AuthMiddleware::authorizePermission('read');

    $service = new EnrollmentsService();
    Flight::json($service->getAll());
});

// Dohvati upis po ID-u - zahtijeva 'read' dozvolu
Flight::route('GET /enrollments/@id', function($id) {
    AuthMiddleware::verifyTokenFromHeader();
    AuthMiddleware::authorizePermission('read');

    $service = new EnrollmentsService();
    $enrollment = $service->getById($id);
    Flight::json($enrollment);
});

// Dodaj novi upis - zahtijeva 'create' dozvolu
Flight::route('POST /enrollments', function() {
    AuthMiddleware::verifyTokenFromHeader();
    AuthMiddleware::authorizePermission('create');

    $data = Flight::request()->data->getData();
    $service = new EnrollmentsService();
    $enrollmentId = $service->add($data);
    Flight::json(['id' => $enrollmentId], 201);
});

// Ažuriraj upis - zahtijeva 'update' dozvolu
Flight::route('PUT /enrollments/@id', function($id) {
    AuthMiddleware::verifyTokenFromHeader();
    AuthMiddleware::authorizePermission('update');

    $data = Flight::request()->data->getData();
    $service = new EnrollmentsService();
    $service->update($id, $data);
    Flight::json(['message' => 'Upis ažuriran.']);
});

// Obriši upis - zahtijeva 'delete' dozvolu
Flight::route('DELETE /enrollments/@id', function($id) {
    AuthMiddleware::verifyTokenFromHeader();
    AuthMiddleware::authorizePermission('delete');

    $service = new EnrollmentsService();
    $service->delete($id);
    Flight::json(['message' => 'Upis obrisan.']);
});
