<?php

namespace Controllers;

/**
 * Setting controller
 */
class Setting extends \Core\Controller
{
    public function __construct()
    {
        parent::__construct();

        // Controllers instances
        $this->user = new \Controllers\User();

        // Models instances
        $this->tahunAjaranModel = new \Models\TahunAjaranModel();
        $this->gelombangModel = new \Models\GelombangModel();
        $this->gelombangJalurModel = new \Models\GelombangJalurModel();
        $this->jalurModel = new \Models\JalurModel();
        $this->infoModel = new \Models\InfoModel();
        $this->kontakModel = new \Models\KontakModel();
        $this->userModel = new \Models\UserModel();
    }

    public function index()
    {
        if ($this->user->isAdmin()) {
            $thnAjar = $this->tahunAjaranModel->getActive();
            $data['thnAjar'] = $thnAjar[0]['tahun_ajaran'];
            $data['page'] = 'setting/panel';
            $data['menu'] = 'admin/menu';
            $data['validSetting'] = true;
            $this->view->load('common/template', $data);
        } else {
            $this->view->responseDefault('403');
        }
    }

    public function tahun()
    {
        if ($this->user->isAdmin()) {
            $tahun = $this->tahunAjaranModel->get();
            $data['tahun'] = $tahun;
            $data['page'] = 'setting/tahun';
            $data['menu'] = 'admin/menu';
            $this->view->load('common/template', $data);
        } else {
            $this->view->responseDefault('403');
        }
    }

    public function addTahun()
    {
        if ($this->user->isAdmin()) {
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $data['page'] = 'setting/tahun_add';
                $data['menu'] = 'admin/menu';
                $this->view->load('common/template', $data);
            } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
                $param = array(
                    'thn' => \Helpers\Request::post('thn'),
                    'ak' => 0
                );
                $this->tahunAjaranModel->add($param);
                $this->uri->redirect(HOME.'/setting/tahun');
            }
        } else {
            $this->view->responseDefault('403');
        }
    }

    public function updateTahun($id)
    {
        if ($this->user->isAdmin()) {
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $data['id'] = $id;
                $data['thn'] = $this->tahunAjaranModel->getbyId($id);
                $data['page'] = 'setting/tahun_update';
                $data['menu'] = 'admin/menu';
                $this->view->load('common/template', $data);
            } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
                $param = array(
                    'thn' => \Helpers\Request::post('thn'),
                    'id' => $id
                );
                $this->tahunAjaranModel->update($param);
                $this->uri->redirect(HOME.'/setting/tahun');
            }
        } else {
            $this->view->responseDefault('403');
        }
    }

    public function gelombang()
    {
        if ($this->user->isAdmin()) {
            $thnAjar = $this->tahunAjaranModel->getActive();
            $thn = $thnAjar[0]['tahun_ajaran'];
            $gels = $this->gelombangModel->getGelsYear($thn);
            $data['thn'] = $thn;
            $data['gels'] = $gels;
            $data['page'] = 'setting/gelombang';
            $data['menu'] = 'admin/menu';
            $this->view->load('common/template', $data);
        } else {
            $this->view->responseDefault('403');
        }
    }

    public function addGelombang()
    {
        if ($this->user->isAdmin()) {
            $thnAjar = $this->tahunAjaranModel->getActive();
            $thn = $thnAjar[0]['tahun_ajaran'];

            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $data['thn'] = $thn;
                $data['page'] = 'setting/gelombang_add';
                $data['menu'] = 'admin/menu';
                $this->view->load('common/template', $data);
            } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
                $td = \Helpers\Request::post('tes');

                if (empty($td)) {
                    $td = null;
                } else {
                    $td = date('Y-m-d', strtotime($td));
                }

                $param = array(
                    'gel' => \Helpers\Request::post('gel'),
                    'idt' => $thnAjar[0]['id_tahun_ajaran'],
                    'od' => date('Y-m-d', strtotime(\Helpers\Request::post('pbuka'))),
                    'cd' => date('Y-m-d', strtotime(\Helpers\Request::post('ptutup'))),
                    'td' => $td,
                    'ad' => date('Y-m-d', strtotime(\Helpers\Request::post('pengu'))),
                    'rd' => date('Y-m-d', strtotime(\Helpers\Request::post('dulang'))),
                );
                $this->gelombangModel->add($param);
                $this->uri->redirect(HOME.'/setting/gelombang');
            }
        } else {
            $this->view->responseDefault('403');
        }
    }

    public function updateGelombang($id)
    {
        if ($this->user->isAdmin()) {
            $thnAjar = $this->tahunAjaranModel->getActive();
            $thn = $thnAjar[0]['tahun_ajaran'];
            $gel = $this->gelombangModel->getbyId($id);

            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $data['thn'] = $thn;
                $data['gelData'] = $gel;
                $data['gel'] = $gel[0]['gelombang'];
                $data['id'] = $gel[0]['id_gel'];
                $data['page'] = 'setting/gelombang_update';
                $data['menu'] = 'admin/menu';
                $this->view->load('common/template', $data);
            } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
                $td = \Helpers\Request::post('tes');

                if (empty($td)) {
                    $td = null;
                } else {
                    $td = date('Y-m-d', strtotime($td));
                }

                $param = array(
                    'gel' => $gel[0]['gelombang'],
                    'od' => date('Y-m-d', strtotime(\Helpers\Request::post('pbuka'))),
                    'cd' => date('Y-m-d', strtotime(\Helpers\Request::post('ptutup'))),
                    'td' => $td,
                    'ad' => date('Y-m-d', strtotime(\Helpers\Request::post('pengu'))),
                    'rd' => date('Y-m-d', strtotime(\Helpers\Request::post('dulang'))),
                    'idg' => $gel[0]['id_gel'],
                    'idt' => $gel[0]['id_tahun_ajaran']
                );
                $this->gelombangModel->update($param);
                $this->uri->redirect(HOME.'/setting/gelombang');
            }
        } else {
            $this->view->responseDefault('403');
        }
    }

    public function deleteGelombang($id)
    {
        if ($this->user->isAdmin()) {
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $this->gelombangModel->delete($id);
                $this->uri->redirect(HOME.'/setting/gelombang');
            }
        } else {
            $this->view->responseDefault('403');
        }
    }

    public function jalur()
    {
        if ($this->user->isAdmin()) {
            $jalur = $this->jalurModel->get();
            $data['jalur'] = $jalur;
            $data['page'] = 'setting/jalur';
            $data['menu'] = 'admin/menu';
            $this->view->load('common/template', $data);
        } else {
            $this->view->responseDefault('403');
        }
    }

    public function addJalur()
    {
        if ($this->user->isAdmin()) {
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $data['page'] = 'setting/jalur_add';
                $data['menu'] = 'admin/menu';
                $this->view->load('common/template', $data);
            } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
                $param = array(
                    'kj' => \Helpers\Request::post('kj'),
                    'nj' => \Helpers\Request::post('nj')
                );
                $this->jalurModel->add($param);
                $this->uri->redirect(HOME.'/setting/jalur');
            }
        } else {
            $this->view->responseDefault('403');
        }
    }

    public function updateJalur()
    {
        if ($this->user->isAdmin()) {
            $id = \Helpers\Request::post('tes_id');

            $jalur = $this->jalurModel->getbyId($id);
            $jid = $jalur[0]['id_jalur'];

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (\Helpers\Request::post('action') == "Edit") {
                    $data['id'] = $jid;
                    $data['jalur'] = $jalur;
                    $data['page'] = 'setting/jalur_update';
                    $data['menu'] = 'admin/menu';
                    $this->view->load('common/template', $data);

                    $kj = \Helpers\Request::post('kj');
                    if (!empty($kj)) {
                        $param = array(
                            'id' => $jid,
                            'kj' => \Helpers\Request::post('kj'),
                            'nj' => \Helpers\Request::post('nj')
                        );
                        $this->jalurModel->update($param);
                        $this->uri->redirect(HOME.'/setting/jalur');
                    }
                } elseif (\Helpers\Request::post('action') == "Delete") {
                    $this->jalurModel->delete($id);
                    $this->uri->redirect(HOME.'/setting/jalur');
                }
            }
        } else {
            $this->view->responseDefault('403');
        }
    }

    public function pagu()
    {
        if ($this->user->isAdmin()) {
            $thnAjar = $this->tahunAjaranModel->getActive();
            $thn = $thnAjar[0]['tahun_ajaran'];
            $thnId = $thnAjar[0]['id_tahun_ajaran'];
            $pagu = $this->gelombangJalurModel->getbyYearId($thnId);
            $data['thn'] = $thn;
            $data['pagu'] = $pagu;
            $data['page'] = 'setting/pagu';
            $data['menu'] = 'admin/menu';
            $this->view->load('common/template', $data);
        } else {
            $this->view->responseDefault('403');
        }
    }

    public function addPagu()
    {
        if ($this->user->isAdmin()) {
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $data['page'] = 'setting/jalur_add';
                $data['menu'] = 'admin/menu';
                $this->view->load('common/template', $data);
            } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
                $param = array(
                    'kj' => \Helpers\Request::post('kj'),
                    'nj' => \Helpers\Request::post('nj')
                );
                $this->jalurModel->add($param);
                $this->uri->redirect(HOME.'/setting/jalur');
            }
        } else {
            $this->view->responseDefault('403');
        }
    }

    public function updatePagu($id)
    {
        if ($this->user->isAdmin()) {
            $jalur = $this->jalurModel->getbyId($id);
            $jid = $jalur[0]['id_jalur'];

            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $data['id'] = $jid;
                $data['jalur'] = $jalur;
                $data['page'] = 'setting/jalur_update';
                $data['menu'] = 'admin/menu';
                $this->view->load('common/template', $data);
            } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
                $param = array(
                    'id' => $jid,
                    'kj' => \Helpers\Request::post('kj'),
                    'nj' => \Helpers\Request::post('nj')
                );
                $this->jalurModel->update($param);
                $this->uri->redirect(HOME.'/setting/jalur');
            }
        } else {
            $this->view->responseDefault('403');
        }
    }

    public function deletePagu($id)
    {
        if ($this->user->isAdmin()) {
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $this->jalurModel->delete($id);
                $this->uri->redirect(HOME.'/setting/jalur');
            }
        } else {
            $this->view->responseDefault('403');
        }
    }

    public function pedoman()
    {
        if ($this->user->isAdmin()) {
            $data['pedoman'] = $this->infoModel->getPedoman();
            $data['menu'] = 'admin/menu';
            $data['title'] = 'Pengaturan Pedoman';
            $data['page'] = 'setting/pedoman';

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $this->infoModel->updatePedoman($_POST['content']);
            }

            $this->view->load('common/template', $data);
        } else {
            $this->view->responseDefault('403');
        }
    }

    public function alur()
    {
        if ($this->user->isAdmin()) {
            $data['alur'] = $this->infoModel->getAlur();
            $data['menu'] = 'admin/menu';
            $data['title'] = 'Pengaturan Alur';
            $data['page'] = 'setting/alur';

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $this->infoModel->updateAlur($_POST['content']);
            }

            $this->view->load('common/template', $data);
        } else {
            $this->view->responseDefault('403');
        }
    }

    public function kontak()
    {
        if ($this->user->isAdmin()) {
            $data['kontak'] = $this->kontakModel->getKontak();
            $data['menu'] = 'admin/menu';
            $data['page'] = 'setting/kontak';
            $this->view->load('common/template', $data);
        } else {
            $this->view->responseDefault('403');
        }
    }

    public function addKontak()
    {
        if ($this->user->isAdmin()) {
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $data['menu'] = 'admin/menu';
                $data['page'] = 'setting/kontak_add';
                $this->view->load('common/template', $data);
            } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
                $param = array(
                    'nk' => \Helpers\Request::post('nama'),
                    'al' => \Helpers\Request::post('alamat'),
                    'tl' => \Helpers\Request::post('tlp'),
                    'hp' => \Helpers\Request::post('hp'),
                    'em' => \Helpers\Request::post('email'),
                    'kt' => 1
                );
                $this->kontakModel->add($param);
                $this->uri->redirect(HOME.'/setting/kontak');
            }
        } else {
            $this->view->responseDefault('403');
        }
    }

    public function updateKontak($id)
    {
        if ($this->user->isAdmin()) {
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $data['id'] = $id;
                $data['kontak'] = $this->kontakModel->getKontakbyId($id);
                $data['menu'] = 'admin/menu';
                $data['page'] = 'setting/kontak_update';
                $data['notif'] = null;
                $this->view->load('common/template', $data);
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $param = array(
                    'id' => $id,
                    'nk' => \Helpers\Request::post('nama'),
                    'al' => \Helpers\Request::post('alamat'),
                    'tl' => \Helpers\Request::post('tlp'),
                    'hp' => \Helpers\Request::post('hp'),
                    'em' => \Helpers\Request::post('email')
                );
                $this->kontakModel->update($param);
                $this->uri->redirect(HOME.'/setting/kontak');
            }

        } else {
            $this->view->responseDefault('403');
        }
    }

    public function deleteKontak($id)
    {
        if ($this->user->isAdmin()) {
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $this->kontakModel->delete($id);
                $this->uri->redirect(HOME.'/setting/kontak');
            }
        } else {
            $this->view->responseDefault('403');
        }
    }

    public function pengguna()
    {
        if ($this->user->isAdmin()) {
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $data['menu'] = 'admin/menu';
                $data['page'] = 'setting/pengguna';
                $data['pengguna'] = $this->userModel->getUserList();
                $data['notif'] = null;
                $this->view->load('common/template', $data);
            }
        } else {
            $this->view->responseDefault('403');
        }
    }

    public function addPengguna()
    {
        if ($this->user->isAdmin()) {
            if ($_SERVER["REQUEST_METHOD"] == "GET") {

            }
        } else {
            $this->view->responseDefault('403');
        }
    }

    public function updatePengguna($id)
    {
        if ($this->user->isAdmin()) {
            if ($_SERVER["REQUEST_METHOD"] == "GET") {

            }
        } else {
            $this->view->responseDefault('403');
        }
    }

    public function deletePengguna($id)
    {
        if ($this->user->isAdmin()) {
            if ($_SERVER["REQUEST_METHOD"] == "GET") {

            }
        } else {
            $this->view->responseDefault('403');
        }
    }
}
