<?php
require_once __DIR__ . '/../dao/EnrollmentsDao.php';
require_once __DIR__ . '/BaseServices.php';

class EnrollmentsService extends BaseService {
    public function __construct() {
        parent::__construct(new EnrollmentsDao());
    }

    public function getEnrollmentsByUser($user_id) {
        return $this->dao->getByUserId($user_id);
    }
}
