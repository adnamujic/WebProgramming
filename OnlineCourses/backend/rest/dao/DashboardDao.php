<?php
require_once 'BaseDao.php';

class DashboardDao extends BaseDao {
    public function __construct() {
        parent::__construct("Dashboard", "dashboardID");
    }
}
?>
