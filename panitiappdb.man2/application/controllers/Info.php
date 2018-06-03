<?php
namespace Controllers;

/**
*
*/
class Info extends \Core\Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->infoModel = new \Models\InfoModel();
    }

    public function showAlur()
    {
        $data = array(
            'menu' => "common/menu",
            'title' => "Alur PPDB",
            'page' => "common/alur",
            'content' => $this->infoModel->getAlur()
        );

        $this->view->load('common/template', $data);
    }

    public function showPedoman()
    {
        $data = array(
            'menu' => "common/menu",
            'title' => "Pedoman PPDB",
            'page' => "common/pedoman",
            'content' => $this->infoModel->getPedoman()
        );

        $this->view->load('common/template', $data);
    }
}
