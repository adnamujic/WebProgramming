<?php
require_once __DIR__ . '/../dao/ReviewsDao.php';
require_once __DIR__ . '/BaseServices.php';

class ReviewsService extends BaseService {
    public function __construct() {
        parent::__construct(new ReviewsDao());
    }

    public function getAverageRating($course_id) {
        return $this->dao->getAverageRatingForCourse($course_id);
    }
}
