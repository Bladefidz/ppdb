<?php
namespace Core;

/**
 * Simplex
 * Simple concept for simple to complex idea
 *
 * PHP application development faremwork for PHP 5.3 or newer
 * @package simplex
 * @author  Hafidz Jazuli Luthfi - hafidz@olacode.com
 * @since   version 0.1
 * @filesource
 */

/**
 * Loader class - Load Model and Views
 */
class Loader
{

    public function __construct()
    {
        $this->model = new \Core\Model();
        $this->view = new \Core\View();
    }

    public function model($modelName)
    {
        $this->model->get($modelName);
    }

    public function view($viewname, $varArray = null)
    {
        $this->view->load($viewname, $varArray);
    }

    public function helper($helperName)
    {
        require_once ROOT_DIR.'/helpers/'.$helperName.'.php';
    }
}
