<?php
require __DIR__ . '/vendor/autoload.php';

// Učitaj sve rute iz backend/rest/routes
require_once __DIR__ . '/backend/rest/routes/UsersRoutes.php';
require_once __DIR__ . '/backend/rest/routes/CoursesRoutes.php';
require_once __DIR__ . '/backend/rest/routes/EnrollmentsRoutes.php';
require_once __DIR__ . '/backend/rest/routes/ReviewsRoutes.php';
require_once __DIR__ . '/backend/rest/routes/DashboardRoutes.php';

// Pokreni FlightPHP aplikaciju
Flight::start();
?>
