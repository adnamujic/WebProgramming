<?php
require_once __DIR__ . '/../services/DashboardServices.php';

// Dohvati sve podatke za dashboard
Flight::route('GET /dashboard', function() {
    $service = new DashboardService();
    Flight::json($service->getAll());
});

// Dohvati podatke za dashboard po ID-u
Flight::route('GET /dashboard/@id', function($id) {
    $service = new DashboardService();
    $dashboardItem = $service->getById($id);
    Flight::json($dashboardItem);
});

// Dodaj novi podatak za dashboard
Flight::route('POST /dashboard', function() {
    $data = Flight::request()->data->getData();
    $service = new DashboardService();
    $dashboardId = $service->add($data);
    Flight::json(['id' => $dashboardId], 201);
});

// Ažuriraj podatak za dashboard
Flight::route('PUT /dashboard/@id', function($id) {
    $data = Flight::request()->data->getData();
    $service = new DashboardService();
    $service->update($id, $data);
    Flight::json(['message' => 'Podatak za dashboard ažuriran.']);
});

// Obriši podatak za dashboard
Flight::route('DELETE /dashboard/@id', function($id) {
    $service = new DashboardService();
    $service->delete($id);
    Flight::json(['message' => 'Podatak za dashboard obrisan.']);
});
?>
