<?php
require_once 'BaseDao.php';

class CoursesDao extends BaseDao {
    public function __construct() {
        parent::__construct("Courses", "courseID");
    }

    //Dodatna metoda – kursevi po instruktoru
    public function getCoursesByInstructor($instructorID) {
        $stmt = $this->connection->prepare("SELECT * FROM Courses WHERE instructorID = :instructorID");
        $stmt->bindParam(':instructorID', $instructorID);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>
