<?php
require __DIR__ . '/vendor/autoload.php';

// Učitaj sve rute iz backend/rest/routes
require_once __DIR__ . '/backend/rest/routes/UsersRoutes.php';
require_once __DIR__ . '/backend/rest/routes/CoursesRoutes.php';
require_once __DIR__ . '/backend/rest/routes/EnrollmentsRoutes.php';
require_once __DIR__ . '/backend/rest/routes/ReviewsRoutes.php';
require_once __DIR__ . '/backend/rest/routes/DashboardRoutes.php';
require_once 'services/AuthService.php';


// Rute za registraciju i login
Flight::route('POST /register', function() {
    $data = Flight::request()->data->getData();
    $authService = new AuthService();
    Flight::json($authService->register($data));
});

Flight::route('POST /login', function() {
    $data = Flight::request()->data->getData();
    $authService = new AuthService();
    Flight::json($authService->login($data));
});


//Globalni error handler
Flight::map('error', function(Exception $ex){
    http_response_code($ex->getCode() ?: 500);
    Flight::json([
        'error' => true,
        'message' => $ex->getMessage(),
        'code' => $ex->getCode() ?: 500
    ]);
});



// Pokreni FlightPHP aplikaciju NA KRAJU
Flight::start();
?>
