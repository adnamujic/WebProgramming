<?php
require_once __DIR__ . '/../services/DashboardServices.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';

// Dohvati sve podatke za dashboard - zahtijeva autentifikaciju i 'read' dozvolu
Flight::route('GET /dashboard', function() {
    AuthMiddleware::verifyTokenFromHeader();
    AuthMiddleware::authorizePermission('read');

    $service = new DashboardService();
    Flight::json($service->getAll());
});

// Dohvati podatak za dashboard po ID-u - zahtijeva 'read' dozvolu
Flight::route('GET /dashboard/@id', function($id) {
    AuthMiddleware::verifyTokenFromHeader();
    AuthMiddleware::authorizePermission('read');

    $service = new DashboardService();
    $dashboardItem = $service->getById($id);
    Flight::json($dashboardItem);
});

// Dodaj novi podatak za dashboard - zahtijeva 'create' dozvolu
Flight::route('POST /dashboard', function() {
    AuthMiddleware::verifyTokenFromHeader();
    AuthMiddleware::authorizePermission('create');

    $data = Flight::request()->data->getData();
    $service = new DashboardService();
    $dashboardId = $service->add($data);
    Flight::json(['id' => $dashboardId], 201);
});

// Ažuriraj podatak za dashboard - zahtijeva 'update' dozvolu
Flight::route('PUT /dashboard/@id', function($id) {
    AuthMiddleware::verifyTokenFromHeader();
    AuthMiddleware::authorizePermission('update');

    $data = Flight::request()->data->getData();
    $service = new DashboardService();
    $service->update($id, $data);
    Flight::json(['message' => 'Podatak za dashboard ažuriran.']);
});

// Obriši podatak za dashboard - zahtijeva 'delete' dozvolu
Flight::route('DELETE /dashboard/@id', function($id) {
    AuthMiddleware::verifyTokenFromHeader();
    AuthMiddleware::authorizePermission('delete');

    $service = new DashboardService();
    $service->delete($id);
    Flight::json(['message' => 'Podatak za dashboard obrisan.']);
});
