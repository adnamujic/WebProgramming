<?php
require_once 'dao/UsersDao.php';
require_once 'dao/CoursesDao.php';
require_once 'dao/DashboardDao.php';
require_once 'dao/ReviewsDao.php';
require_once 'dao/EnrollmentsDao.php';*/

$usersDao = new UsersDao();
$coursesDao = new CoursesDao();
$dashboardDao = new DashboardDao();
$reviewsDao = new ReviewsDao();
$enrollmentsDao = new EnrollmentsDao();*/


//Kada pokrecem jednu po jednu operaciju ne unose mi se podaci u bazu iako u localhostu mogu otvoriti test.php



// TESTING USERS ENTITY
/*
//Insert two new users
$usersDao->insert([
    'name' => 'Jane Smith',
    'email' => 'jane.smith@example.com',
    'password' => password_hash('password456', PASSWORD_DEFAULT),
    'role' => 'Student'
]);

$usersDao->insert([
    'name' => 'John Doe',
    'email' => 'john.doe@example.com',
    'password' => password_hash('password123', PASSWORD_DEFAULT),
    'role' => 'Admin'
]);

//Fetch all users
$users = $usersDao->getAll();
echo "All users in the database:\n";
foreach ($users as $user) {
    echo 'ID: ' . $user['id'] . ' | Name: ' . $user['name'] . ' | Email: ' . $user['email'] . ' | Role: ' . $user['role'] . "\n";
}
*/

// TESTING COURSES ENTITY
/*
//Insert two new courses
$coursesDao->insert([
    'title' => 'Web Development 101',
    'description' => 'An introductory course to web development.',
    'instructorID' => 1
]);

$coursesDao->insert([
    'title' => 'Advanced Java Programming',
    'description' => 'An advanced course covering Java programming techniques.',
    'instructorID' => 2
]);

//Fetch all courses
$courses = $coursesDao->getAll();
echo "All courses in the database:\n";
foreach ($courses as $course) {
    echo 'CourseID: ' . $course->courseID . ' | Title: ' . $course->title . ' | Description: ' . $course->description . "\n";
}

//Update a course
$updatedData = [
    'title' => 'Web Development 101 (Updated)',
    'description' => 'An introductory course to web development (updated version).',
];
$courseToUpdate = $coursesDao->getById(1); // Assume courseID 1 exists
if ($courseToUpdate) {
    $coursesDao->update($courseToUpdate->courseID, $updatedData);
    echo "Course with ID " . $courseToUpdate->courseID . " was updated successfully.\n";
} else {
    echo "Course not found.\n";
}

//Delete a course
$courseToDelete = $coursesDao->getById(2); // Assume courseID 2 exists
if ($courseToDelete) {
    $deleted = $coursesDao->delete($courseToDelete->courseID);
    if ($deleted) {
        echo "Course with ID " . $courseToDelete->courseID . " was deleted successfully.\n";
    } else {
        echo "Failed to delete course.\n";
    }
} else {
    echo "Course not found.\n";
}
*/


// TESTING DASHBOARD ENTITY
/*
//Insert a new operation record (Example: a 'CREATE' operation)
$dashboardDao->insert([
    'userID' => 1, // Assume user with ID 1 exists
    'operationType' => 'CREATE'
]);

//Fetch all operation records
$operations = $dashboardDao->getAll();
echo "All operations:\n";
foreach ($operations as $operation) {
    echo 'OperationID: ' . $operation->operationID . ' | UserID: ' . $operation->userID . ' | Type: ' . $operation->operationType . ' | Time: ' . $operation->operationTime . "\n";
}
*/

//TESTING REVIEWS ENTITY
/*
//Insert a new review for a course
$reviewsDao->insert([
    'userID' => 1,  // Assume user with ID 1 exists
    'courseID' => 1,  // Assume course with ID 1 exists
    'rating' => 4,
    'comment' => 'Great course! Learned a lot.'
]);

//Fetch all reviews
$reviews = $reviewsDao->getAll();
echo "All reviews:\n";
foreach ($reviews as $review) {
    echo 'ReviewID: ' . $review->reviewID . ' | UserID: ' . $review->userID . ' | CourseID: ' . $review->courseID . ' | Rating: ' . $review->rating . ' | Comment: ' . $review->comment . ' | Created At: ' . $review->createdAt . "\n";
}

//Delete a review
$reviewToDelete = $reviewsDao->getById(1); // Assume reviewID 1 exists
if ($reviewToDelete) {
    $reviewsDao->delete($reviewToDelete->reviewID);
    echo "Review with ID " . $reviewToDelete->reviewID . " was deleted successfully.\n";
} else {
    echo "Review record not found.\n";
}
*/

// TESTING ENROLLMENTS ENTITY
/*
$enrollmentsDao->insert([
    'userID' => 1,  // Pretpostavljamo da korisnik sa ID 1 postoji
    'courseID' => 1,  // Pretpostavljamo da kurs sa ID 1 postoji
    'enrolledAt' => date('Y-m-d H:i:s')  // Trenutni datum i vreme
]);

$enrollmentsDao->insert([
    'userID' => 2,  // Pretpostavljamo da korisnik sa ID 2 postoji
    'courseID' => 2,  // Pretpostavljamo da kurs sa ID 2 postoji
    'enrolledAt' => date('Y-m-d H:i:s')  // Trenutni datum i vreme
]);

//Fetch all enrollments
$enrollments = $enrollmentsDao->getAll();
echo "All Enrollments:\n";
foreach ($enrollments as $enrollment) {
    echo 'EnrollmentID: ' . $enrollment->enrollmentID . ' | UserID: ' . $enrollment->userID . ' | CourseID: ' . $enrollment->courseID . ' | Enrolled At: ' . $enrollment->enrolledAt . "\n";
}
*/

?>
