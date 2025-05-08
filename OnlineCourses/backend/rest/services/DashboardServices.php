<?php
require_once __DIR__ . '/../dao/DashboardDao.php';
require_once __DIR__ . '/BaseServices.php';

class DashboardService extends BaseService {
    public function __construct() {
        parent::__construct(new DashboardDao());
    }

    // Dohvati sve osnovne metrike za dashboard
    public function getDashboardMetrics() {
        // Pretpostavljamo da DashboardDao vraća osnovne podatke kao što su broj korisnika, broj kurseva itd.
        $metrics = $this->dao->getMetrics();

        return $metrics;
    }

    // Dodaj novu metriku na dashboard (npr. broj novih prijava)
    public function addMetric($data) {
        // Dodaj novu metriku (ako je potrebno)
        return $this->dao->addMetric($data);
    }

    // Ažuriraj postojeću metriku (npr. ažuriranje broja korisnika ili kurseva)
    public function updateMetric($id, $data) {
        return $this->dao->updateMetric($id, $data);
    }

    // Obriši metriku
    public function deleteMetric($id) {
        return $this->dao->deleteMetric($id);
    }

    // Dohvati specifičnu metriku po ID-u
    public function getMetricById($id) {
        return $this->dao->getMetricById($id);
    }

    // Dohvati sve metrike
    public function getAllMetrics() {
        return $this->dao->getAllMetrics();
    }
}
