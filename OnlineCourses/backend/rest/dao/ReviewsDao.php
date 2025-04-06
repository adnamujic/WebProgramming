<?php
require_once 'BaseDao.php';

class ReviewsDao extends BaseDao {
    public function __construct() {
        // Tabela 'Reviews', primarni ključ 'reviewID'
        parent::__construct("Reviews", "reviewID");
    }
}
?>
