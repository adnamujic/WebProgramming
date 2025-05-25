<?php
require_once __DIR__ . '/../services/ReviewsServices.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';

// Dohvati sve recenzije - zahtijeva 'read' dozvolu
Flight::route('GET /reviews', function() {
    AuthMiddleware::verifyTokenFromHeader();
    AuthMiddleware::authorizePermission('read');

    $service = new ReviewsService();
    Flight::json($service->getAll());
});

// Dohvati recenziju po ID-u - zahtijeva 'read' dozvolu
Flight::route('GET /reviews/@id', function($id) {
    AuthMiddleware::verifyTokenFromHeader();
    AuthMiddleware::authorizePermission('read');

    $service = new ReviewsService();
    $review = $service->getById($id);
    Flight::json($review);
});

// Dodaj novu recenziju - zahtijeva 'create' dozvolu
Flight::route('POST /reviews', function() {
    AuthMiddleware::verifyTokenFromHeader();
    AuthMiddleware::authorizePermission('create');

    $data = Flight::request()->data->getData();
    $service = new ReviewsService();
    $reviewId = $service->add($data);
    Flight::json(['id' => $reviewId], 201);
});

// Ažuriraj recenziju - zahtijeva 'update' dozvolu
Flight::route('PUT /reviews/@id', function($id) {
    AuthMiddleware::verifyTokenFromHeader();
    AuthMiddleware::authorizePermission('update');

    $data = Flight::request()->data->getData();
    $service = new ReviewsService();
    $service->update($id, $data);
    Flight::json(['message' => 'Recenzija ažurirana.']);
});

// Obriši recenziju - zahtijeva 'delete' dozvolu
Flight::route('DELETE /reviews/@id', function($id) {
    AuthMiddleware::verifyTokenFromHeader();
    AuthMiddleware::authorizePermission('delete');

    $service = new ReviewsService();
    $service->delete($id);
    Flight::json(['message' => 'Recenzija obrisana.']);
});
