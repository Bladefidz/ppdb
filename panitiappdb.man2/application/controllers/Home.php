<?php
namespace Controllers;

use Core\Controller;

/**
 * Home Class - Controller
 */
class Home extends Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->user = new \Controllers\User();
        $this->pendaftaranModel = new \Models\PendaftaranModel();
        $this->thnAjarModel = new \Models\TahunAjaranModel();
        $this->gelombangModel = new \Models\GelombangModel();
        $this->jalurModel = new \Models\JalurModel();
        $this->seleksiModel = new \Models\SeleksiModel();
    }

    public function index()
    {
        if ($this->user->isAdmin() || $this->user->isPegawai()) {
            $this->admin();
        } else {
            $this->uri->redirect(HOME."/login");
        }
    }

    private function admin()
    {
        $gelsStat = $this->gelombangModel->getGelsYear(date('Y'));
        $idThnAjar = $gelsStat[0]['id_tahun_ajaran'];
        $jalur = $this->jalurModel->getJalur();
        $pagu = $this->jalurModel->getTotalPagu(date('Y'))[0]['pagu'];

        if (count($gelsStat) > 0) {
            $numPendf = $this->pendaftaranModel->numbyYearId($idThnAjar);
            $numComplete = $this->pendaftaranModel->numbyYidVid($idThnAjar, 3);
            $numRecieve = count($this->seleksiModel->getDiterima(date('Y')));
            $numValidated = $this->pendaftaranModel->numbyYidVid($idThnAjar, 7);

            $data = array(
                'readyForNowYear' => true,
                'thnAjar' => $gelsStat[0]['tahun_ajaran'],
                'thnAjaran' => $gelsStat[0]['tahun_ajaran'].'/'.($gelsStat[0]['tahun_ajaran']+1),
                'numGels' => count($gelsStat),
                'numJalur' => count($jalur),
                'pagu' => $pagu,
                'numPendf' => $numPendf,
                'numComplete' => $numComplete,
                'numRecieve' => $numRecieve,
                'numValidated' => $numValidated,
                'page' => "admin/home",
                'title' => "Halaman Utama",
                'menu' => "admin/menu"
            );
        } else {
            $oldGelsStat = $this->gelombangModel->getGelsYear((date('Y')-1));

            $data = array(
                'readyForNowYear' => false,
                'thnAjar' => date('Y').'/'.(date('Y')+1),
                'numGels' => count($oldGelsStat),
                'numJalur' => count($jalur),
                'pagu' => 0,
                'numPendf' => 0,
                'numComplete' => 0,
                'numRecieve' => 0,
                'numValidated' => 0,
                'page' => "admin/home",
                'title' => "Halaman Utama",
                'menu' => "admin/menu"
            );
        }

        $this->view->load('common/template', $data);
    }
}
