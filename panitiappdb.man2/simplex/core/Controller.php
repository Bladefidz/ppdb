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

use Core\Input;

/**
 * Controller class.
 *
 * @author Hafidz Jazuli Luthfi - hafidz@olacode.com
 */
class Controller extends Application
{
    /**
     * Model instance
     *
     * @var instance
     */
    protected $model;

    /**
     * View instance
     *
     * @var instance
     */
    protected $view;

    /**
     * Load instance
     *
     * @var instance
     */
    protected $load;

    /**
     * Uri instance
     *
     * @var instance
     */
    protected $uri;

    /**
     * Session instance
     *
     * @var instance
     */
    protected $sessionHandler;

    /**
     * FormHelper instance
     *
     * @var instance
     */
    protected $formHelper;

    /**
     * Temporary of array variable used by view
     *
     * @var array
     */
    public $tmp;

    public function __construct()
    {
        parent::__construct();

        // Instances from core
        $this->view = new \Core\View();
        $this->model = new \Core\Model();
        $this->load = new \Core\Loader();
        $this->uri = new \Core\Uri();

        // Instances from libraries
        $this->sessionHandler = new \Libraries\SessionHandler();

        // Instances from helpers
        $this->formHelper = new \Helpers\FormHelper();
    }

    /**
     * Get view instance
     *
     * @return view instance
     */
    protected function getView($view, array $varArray = array())
    {
        if ($this->view->isExist($view)) {
            if (count($varArray) > 0) {
                $this->tmp = $varArray;
                extract($this->tmp);
            } else {
                if (count($this->tmp) > 0) {
                    extract($this->tmp);
                }
            }

            require_once $this->view->baseDir."/".$view.'.php';
        }
    }

    /**
     * Get model instance
     *
     * @return model instance
     */
    protected function getModel($model)
    {
        return $this->model->load($model);
    }
}
