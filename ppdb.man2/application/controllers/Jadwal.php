<?php
namespace Controllers;

/**
*
*/
class Jadwal extends \Core\Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->gelombangModel = $this->model->load('GelombangModel');
    }

    public function getJadwal()
    {
        $yearNow = date('Y');
        $gelsDetail = $this->gelombangModel->getGelsYear($yearNow);

        if (count($gelsDetail)>0) {
            $data = array(
                'thnAjar' => $yearNow.'/'.($yearNow+1),
                'gelsDetail' => $gelsDetail,
                'title' => "Jadwal Pendaftaran",
                'menu' => "common/menu",
                'page' => "common/jadwal"
            );
        } else {
            $data = array(
                'title' => "Jadwal Pendaftaran",
                'menu' => "common/menu",
                'page' => "common/jadwal_not_ready"
            );
        }

        $this->view->load('common/template', $data);
    }
}
