<?php
namespace Controllers;

/**
 * Home Class - Controller
 */
class Home extends \Core\Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->thnAjarModel = new \Models\TahunAjaranModel();
        $this->gelombangModel = new \Models\GelombangModel();

        $this->today = new \DateTime("now");
    }

    public function index()
    {
        $user_session = isset($_SESSION['pendf_session']) ? $_SESSION['pendf_session'] : null;
        if ($user_session != null || !empty($user_session)) {
            $this->dashboard();
        } else {
            $this->home();
        }
    }

    private function dashboard()
    {
        $data['menu'] = "user/menu";
        $data['page'] =  "user/dashboard";
        $data['title'] = "Dashboard";
        $this->view->load('common/template', $data);
    }

    private function home()
    {
        $regStats = $this->gelombangModel->getGelStat();

        $data['menu'] =  "common/menu";

        if ($this->thnAjarModel->checkThnAjar(date('Y'))) {
            $data['thnAjar'] = $regStats['study_year'];
            $data['gelombangKe'] = $regStats['gelombang'];
            $data['due'] = date_create($regStats['close_date']);
            $data['daftarUlang'] = date_create($regStats['recieve_date']);

            if ($this->gelombangModel->isOpen) {
                $data['durasi'] = $regStats['countdown'];
                $data['page'] =  "common/registration_open";
            } else {
                if (date('now') >= $regStats['announcement_date']) {
                    $data['page'] =  "common/announcement";
                } else {
                    $data['close_info'] = $this->gelombangModel->closeInfo;
                    $data['page'] =  "common/registration_close";
                }
            }
        } else {
            $data['thnAjar'] = date('Y').'/'.(date('Y')+1);
            $data['page'] =  "common/registration_not_ready";
        }

        $data['title'] = "Home";
        $this->view->load('common/template', $data);
    }
}
