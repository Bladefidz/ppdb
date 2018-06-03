<?php

namespace Controllers;

/**
 *
 */
class Seleksi extends \Core\Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->user = new \Controllers\User();

        $this->pendaftaranModel = new \Models\PendaftaranModel();
        $this->seleksiModel = new \Models\SeleksiModel();
        $this->tahunAjaranModel = new \Models\TahunAjaranModel();
        $this->gelombangModel = new \Models\GelombangModel();
        $this->gelombangJalurModel = new \Models\GelombangJalurModel();
        $this->jalurModel = new \Models\JalurModel();
    }

    public function index()
    {
        if ($this->user->isAdmin() || $this->user->isPegawai()) {
            $thnAjar = $this->tahunAjaranModel->getActive();
            $thn = $thnAjar[0]['tahun_ajaran'];
            $gels = $this->gelombangModel->getGelsYear($thn);

            $data['thn'] = $thn;
            $data['gels'] = $gels;
            $data['page'] = 'seleksi/panel_seleksi';
            $data['menu'] = 'admin/menu';
            $this->view->load('common/template', $data);
        } else {
            $this->view->responseDefault('403');
        }
    }

    public function proses($gelId)
    {
        if ($this->user->isAdmin() || $this->user->isPegawai()) {
            $gel = $this->gelombangModel->getbyId($gelId);
            $gelKuota = $this->seleksiModel->getKuotaGelombang($gel[0]['id_gel']);
            $jalurKuotas = $this->seleksiModel->getKuotaJalur($gel[0]['id_gel']);
            $selData = $this->seleksiModel->getbyGelId($gel[0]['id_gel']);

            $data['thn'] = $gel[0]['tahun_ajaran'];
            $data['gel'] = $gel[0]['gelombang'];
            $data['gelKuota'] = $gelKuota;
            $data['jalurKuotas'] = $jalurKuotas;
            $data['numJalur'] = count($jalurKuotas);
            $data['selData'] = $selData;
            $data['numData'] = count($selData);
            $data['page'] = 'seleksi/proses_seleksi';
            $data['menu'] = 'admin/menu';
            $this->view->load('common/template', $data);
        } else {
            $this->view->responseDefault('403');
        }
    }

    public function keputusan($id, $idjalurRec, $idjalurKep)
    {
        if ($this->user->isAdmin() || $this->user->isPegawai()) {
            $cpd = $this->seleksiModel->getbyId($id);
            $id = $cpd[0]['id_pendaftaran'];
            $gelId = $cpd[0]['id_gel'];
            $gel = $this->gelombangModel->getbyId($gelId);

            $data['idjalurRec'] = $idjalurRec;
            $data['idjalurKep'] = $idjalurKep;

            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $data['thn'] = $gel[0]['tahun_ajaran'];
                $data['gel'] = $gel[0]['gelombang'];
                $data['cpd'] = $cpd;
                $data['id'] = $id;
                $data['rekomendasi'] = $this->jalurModel->getbyId($idjalurRec)[0]['nama_jalur'];
                $data['pilJalur'] = $this->jalurModel->getJalurbyGelid($gelId);
                $data['keputusan'] = $this->jalurModel->getbyId($idjalurKep);
                $data['page'] = 'seleksi/keputusan';
                $data['menu'] = 'admin/menu';
                $this->view->load('common/template', $data);
            } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
                $kep = \Helpers\Request::post('kep');

                if ($idjalurKep == 0) {
                    $this->seleksiModel->addKeputusan($id, $kep);
                } else {
                    $this->seleksiModel->updateKeputusan($id, $kep);
                }

                $this->uri->redirect(HOME.'/seleksi/proses/'.$gelId);
            } else {
                $this->view->responseDefault('404');
            }
        } else {
            $this->view->responseDefault('403');
        }
    }

    public function data()
    {
        if ($this->user->isAdmin() || $this->user->isPegawai()) {
            $thnAjar = $this->tahunAjaranModel->getActive();
            $thn = $thnAjar[0]['tahun_ajaran'];
            $gels = $this->gelombangModel->getGelsYear($thn);

            $data['thn'] = $thn;
            $data['gels'] = $gels;
            $data['page'] = 'seleksi/panel_final';
            $data['menu'] = 'admin/menu';
            $this->view->load('common/template', $data);
        } else {
            $this->view->responseDefault('403');
        }
    }

    public function hasil($gelId)
    {
        if ($this->user->isAdmin() || $this->user->isPegawai()) {
            $gel = $this->gelombangModel->getbyId($gelId);
            $gelKuota = $this->seleksiModel->getKuotaGelombang($gel[0]['id_gel']);
            $jalurKuotas = $this->seleksiModel->getKuotaJalur($gel[0]['id_gel']);
            $selData = $this->seleksiModel->getbyGelId($gel[0]['id_gel']);

            $data['thn'] = $gel[0]['tahun_ajaran'];
            $data['gel'] = $gel[0]['gelombang'];
            $data['gelKuota'] = $gelKuota;
            $data['jalurKuotas'] = $jalurKuotas;
            $data['numJalur'] = count($jalurKuotas);
            $data['selData'] = $selData;
            $data['numData'] = count($selData);
            $data['page'] = 'seleksi/data_hasil';
            $data['menu'] = 'admin/menu';
            $this->view->load('common/template', $data);
        } else {
            $this->view->responseDefault('403');
        }
    }

    public function aksi()
    {
        if ($this->user->isAdmin() || $this->user->isPegawai()) {
            $year = date('Y');
            $yearId = $this->tahunAjaranModel->getThnAjarId($year);
            $cpd = $this->pendaftaranModel->getbyYidGidVid($yearId, 3);

            $data = array(
                'yearId' => $yearId,
                'year' => $year,
                'dataCpd' => $cpd,
                'numDataCpd' => count($cpd),
                'title' => '',
                'menu' => 'admin/menu',
                'page' => 'seleksi/proses_seleksi',
            );
            $this->view->load('common/template', $data);
        } else {
            $this->view->responseDefault('403');
        }
    }
}
