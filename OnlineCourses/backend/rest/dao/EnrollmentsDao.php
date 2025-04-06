<?php
require_once 'BaseDao.php';

class EnrollmentsDao extends BaseDao {
    public function __construct() {
        // Koristimo naziv tabele 'Enrollments' i primarni ključ 'enrollmentID'
        parent::__construct("Enrollments", "enrollmentID");
    }
}
?>
