<?php
require_once __DIR__ . '/../dao/CoursesDao.php';
require_once __DIR__ . '/BaseServices.php';

class CoursesService extends BaseService {
    public function __construct() {
        parent::__construct(new CoursesDao());
    }

    public function getCoursesByCategory($category) {
        return $this->dao->getCoursesByCategory($category);
    }
}
