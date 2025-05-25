<?php
require_once __DIR__ . '/../services/CoursesServices.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';
require_once __DIR__ . '/../middleware/Logger.php';

// Jednostavna funkcija za validaciju podataka kursa
function validateCourseData($data) {
    $errors = [];

    if (empty($data['name'])) {
        $errors[] = "Polje 'name' je obavezno.";
    }
    if (empty($data['description'])) {
        $errors[] = "Polje 'description' je obavezno.";
    }

    return $errors;
}

// Dohvati sve kurseve - zahtijeva autentifikaciju i dozvolu 'read'
Flight::route('GET /courses', function() {
    AuthMiddleware::verifyTokenFromHeader();
    AuthMiddleware::authorizePermission('read');

    $service = new CoursesService();
    Flight::json($service->getAll());
});

// Dohvati kurs po ID-u - zahtijeva autentifikaciju i dozvolu 'read'
Flight::route('GET /courses/@id', function($id) {
    AuthMiddleware::verifyTokenFromHeader();
    AuthMiddleware::authorizePermission('read');

    $service = new CoursesService();
    $course = $service->getById($id);
    Flight::json($course);
});

// Dodaj novi kurs - zahtijeva 'create' dozvolu i validaciju
Flight::route('POST /courses', function() {
    AuthMiddleware::verifyTokenFromHeader();
    AuthMiddleware::authorizePermission('create');

    $data = Flight::request()->data->getData();

    $errors = validateCourseData($data);
    if (!empty($errors)) {
        Flight::json(['errors' => $errors], 400);
        return;
    }

    $service = new CoursesService();
    $courseId = $service->add($data);

    //Ovdje koristim logger
    error_log("Course created: ID $courseId by user " . Flight::get('user')->id);

    Flight::json(['id' => $courseId], 201);
});

// Ažuriraj kurs - zahtijeva 'update' dozvolu i validaciju
Flight::route('PUT /courses/@id', function($id) {
    AuthMiddleware::verifyTokenFromHeader();
    AuthMiddleware::authorizePermission('update');

    $data = Flight::request()->data->getData();

    $errors = validateCourseData($data);
    if (!empty($errors)) {
        Flight::json(['errors' => $errors], 400);
        return;
    }

    $service = new CoursesService();
    $service->update($id, $data);

    //I ovdje koristim logger
    error_log("Course updated: ID $id by user " . Flight::get('user')->id);

    Flight::json(['message' => 'Kurs ažuriran.']);
});

// Obriši kurs - zahtijeva 'delete' dozvolu
Flight::route('DELETE /courses/@id', function($id) {
    AuthMiddleware::verifyTokenFromHeader();
    AuthMiddleware::authorizePermission('delete');

    $service = new CoursesService();
    $service->delete($id);

    //Jos jednom koristim logger
    error_log("Course deleted: ID $id by user " . Flight::get('user')->id);

    Flight::json(['message' => 'Kurs obrisan.']);
});
