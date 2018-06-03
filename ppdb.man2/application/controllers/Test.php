<?php
namespace Controllers;

/**
 *
 */
class Test extends \Core\Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->gelombangModel = new \Models\GelombangModel;
    }

    public function testGel()
    {
        echo '<pre><h4>';
        print_r($this->gelombangModel->test());
        echo '</h4></pre>';
    }
}
