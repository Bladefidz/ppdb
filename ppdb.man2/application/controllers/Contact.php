<?php
namespace Controllers;

/**
*
*/
class Contact extends \Core\Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->contactModel = $this->model->load('ContactModel');
    }

    public function getContact()
    {
        $con = $this->contactModel->getKonPanitia()[0];

        $data = array(
            'name' => $con['nama_kontak'],
            'address' => $con['alamat'],
            'telp' => $con['telepon'],
            'email' => $con['email'],
            'title' => "Kontak Panitia PPDB",
            'menu' => "common/menu",
            'page' => "common/kontak"
        );

        $this->view->load('common/template', $data);
    }
}
