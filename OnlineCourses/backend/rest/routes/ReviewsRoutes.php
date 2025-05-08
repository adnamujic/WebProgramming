<?php
require_once __DIR__ . '/../services/ReviewsServices.php';

// Dohvati sve recenzije
Flight::route('GET /reviews', function() {
    $service = new ReviewsService();
    Flight::json($service->getAll());
});

// Dohvati recenziju po ID-u
Flight::route('GET /reviews/@id', function($id) {
    $service = new ReviewsService();
    $review = $service->getById($id);
    Flight::json($review);
});

// Dodaj novu recenziju
Flight::route('POST /reviews', function() {
    $data = Flight::request()->data->getData();
    $service = new ReviewsService();
    $reviewId = $service->add($data);
    Flight::json(['id' => $reviewId], 201);
});

// Ažuriraj recenziju
Flight::route('PUT /reviews/@id', function($id) {
    $data = Flight::request()->data->getData();
    $service = new ReviewsService();
    $service->update($id, $data);
    Flight::json(['message' => 'Recenzija ažurirana.']);
});

// Obriši recenziju
Flight::route('DELETE /reviews/@id', function($id) {
    $service = new ReviewsService();
    $service->delete($id);
    Flight::json(['message' => 'Recenzija obrisana.']);
});
?>
