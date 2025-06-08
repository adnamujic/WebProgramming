<?php
require_once __DIR__ . '/../dao/DashboardDao.php';
require_once __DIR__ . '/BaseService.php';

class DashboardService extends BaseService {
    public function __construct() {
        parent::__construct(new DashboardDao());
    }

    public function getAll() {
        return $this->getAllMetrics();
    }

    public function getById($id) {
        return $this->getMetricById($id);
    }

    public function add($data) {
        return $this->addMetric($data);
    }

    public function update($id, $data) {
        return $this->updateMetric($id, $data);
    }

    public function delete($id) {
        return $this->deleteMetric($id);
    }

    // Stvarne implementacije
    public function getDashboardMetrics() {
        return $this->dao->getMetrics();
    }

    public function addMetric($data) {
        return $this->dao->addMetric($data);
    }

    public function updateMetric($id, $data) {
        return $this->dao->updateMetric($id, $data);
    }

    public function deleteMetric($id) {
        return $this->dao->deleteMetric($id);
    }

    public function getMetricById($id) {
        return $this->dao->getMetricById($id);
    }

    public function getAllMetrics() {
        return $this->dao->getAllMetrics();
    }
}
