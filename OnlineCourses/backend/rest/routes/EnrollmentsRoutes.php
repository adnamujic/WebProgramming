<?php
require_once __DIR__ . '/../services/EnrollmentsServices.php';

// Dohvati sve upise
Flight::route('GET /enrollments', function() {
    $service = new EnrollmentsService();
    Flight::json($service->getAll());
});

// Dohvati upis po ID-u
Flight::route('GET /enrollments/@id', function($id) {
    $service = new EnrollmentsService();
    $enrollment = $service->getById($id);
    Flight::json($enrollment);
});

// Dodaj novi upis
Flight::route('POST /enrollments', function() {
    $data = Flight::request()->data->getData();
    $service = new EnrollmentsService();
    $enrollmentId = $service->add($data);
    Flight::json(['id' => $enrollmentId], 201);
});

// Ažuriraj upis
Flight::route('PUT /enrollments/@id', function($id) {
    $data = Flight::request()->data->getData();
    $service = new EnrollmentsService();
    $service->update($id, $data);
    Flight::json(['message' => 'Upis ažuriran.']);
});

// Obriši upis
Flight::route('DELETE /enrollments/@id', function($id) {
    $service = new EnrollmentsService();
    $service->delete($id);
    Flight::json(['message' => 'Upis obrisan.']);
});
?>
