<?php
require_once __DIR__ . '/../services/CoursesServices.php';

// Dohvati sve kurseve
Flight::route('GET /courses', function() {
    $service = new CoursesService();
    Flight::json($service->getAll());
});

// Dohvati kurs po ID-u
Flight::route('GET /courses/@id', function($id) {
    $service = new CoursesService();
    $course = $service->getById($id);
    Flight::json($course);
});

// Dodaj novi kurs
Flight::route('POST /courses', function() {
    $data = Flight::request()->data->getData();
    $service = new CoursesService();
    $courseId = $service->add($data);
    Flight::json(['id' => $courseId], 201);
});

// Ažuriraj kurs
Flight::route('PUT /courses/@id', function($id) {
    $data = Flight::request()->data->getData();
    $service = new CoursesService();
    $service->update($id, $data);
    Flight::json(['message' => 'Kurs ažuriran.']);
});

// Obriši kurs
Flight::route('DELETE /courses/@id', function($id) {
    $service = new CoursesService();
    $service->delete($id);
    Flight::json(['message' => 'Kurs obrisan.']);
});
?>
