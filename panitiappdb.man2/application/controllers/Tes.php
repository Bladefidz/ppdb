<?php
namespace Controllers;

/**
*
*/
class Tes extends \Core\Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->user = new \Controllers\User();

        $this->tesModel = new \Models\TesModel();
        $this->tahunAjaranModel = new \Models\TahunAjaranModel();
    }

    public function index()
    {
        if ($this->user->isAdmin() || $this->user->isPegawai()) {
            $thnAjar = $this->tahunAjaranModel->getActive();
            $thn = $thnAjar[0]['tahun_ajaran'];
            $gels = $this->tesModel->getGelOption($thn);

            $data['thn'] = $thn;
            $data['gels'] = $gels;
            $data['page'] = 'tes/tes_gelombang';
            $data['menu'] = 'admin/menu';
            $this->view->load('common/template', $data);
        } else {
            $this->view->responseDefault('403');
        }
    }

    public function data($gelId)
    {
        if ($this->user->isAdmin() || $this->user->isPegawai()) {
            $data['tesData'] = $this->tesModel->show($gelId);
            
            if (!empty($data['tesData'])) {
                $data['thn'] = $data['tesData'][0]['tahun_ajaran'];
                $data['gel'] = $data['tesData'][0]['gelombang'];
            }
            
            $data['numData'] = count($data['tesData']);
            $data['page'] = 'tes/tes_data';
            $data['menu'] = 'admin/menu';
            $this->view->load('common/template', $data);
        } else {
            $this->view->responseDefault('403');
        }
    }

    public function update($id)
    {
        if ($this->user->isAdmin() || $this->user->isPegawai()) {
            $cpd = $this->tesModel->get($id);
            $id = $cpd[0]['id_pendaftaran'];
            $idGel = $cpd[0]['id_gel'];

            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $data['cpd'] = $cpd;
                $data['id'] = $id;
                $data['page'] = 'tes/tes_update';
                $data['menu'] = 'admin/menu';
                $this->view->load('common/template', $data);
            } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nt = \Helpers\Request::post('nt');
                $this->tesModel->update($nt, $id);
                $this->uri->redirect(HOME.'/tes/data/'.$idGel);
            } else {
                $this->view->responseDefault('404');
            }
        } else {
            $this->view->responseDefault('403');
        }
    }
}
