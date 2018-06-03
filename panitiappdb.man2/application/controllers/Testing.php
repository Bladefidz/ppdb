<?php
namespace Controllers;

/**
*
*/
class Testing extends \Core\Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->pendaftaranModel = new \Models\PendaftaranModel();
        $this->sekolahAsalModel = new \Models\SekolahAsalModel();
        $this->tesModel = new \Models\TesModel();
        $this->testingModel = new \Models\TestingModel();
    }

    public function testWasVerified($nisn, $gel, $thn)
    {
        $param = array(
            'nisn' => (int) $nisn,
            'gel' => $gel,
            'thn' => $thn
        );
        var_dump($this->pendaftaranModel->wasVerified($param));
    }

    public function insert($key, $value)
    {
        var_dump($this->testingModel->insert($key, $value));
    }

    public function verify()
    {
        var_dump($this->testingModel->verify("hafidz", "hafitto"));
    }

    public function test()
    {
        $tesData = $this->tesModel->show(1);
        var_dump($tesData);
    }

    public function testUriSegment()
    {
        var_dump($this->uri->segment());
    }
}
