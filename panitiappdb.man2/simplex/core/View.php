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
 * Simplex View Class
 * Load end-user interface
 *
 * @author Hafidz Jazuli Luthfi - hafidz@olacode.com
 */
class View
{
    /**
     * View base directory
     *
     * @var string
     */
    public $baseDir;

    /**
     * Setter for array builder retrieved by local variable in controller
     * Alternative of $varArray argument
     *
     * @var array
     */
    protected $variables = array();

    /**
     * Data strored in view
     *
     * @var array
     */
    public $data = array();

    /**
     * Uri instance
     *
     * @var instance
     */
    protected $uri;

    /**
     * FormDesigner instance
     *
     * @var instance
     */
    protected $formHelper;

    public function __construct()
    {
    	$this->baseDir = ROOT_DIR.'/application/views';

        // Instances from core
        $this->uri = new \Core\Uri();

        // Instances from Helpers
        $this->formHelper = new \Helpers\FormHelper();
    }

    /**
     * Setter for variables values
     *
     * @param $name is array name
     * @param $value is value of an array
     */
    public function set($name, $value)
    {
        $this->variables[$name] = $value;
    }

    /**
     * Check the view exist or not
     *
     * @param $view string of view name
     */
    public function isExist($view)
    {
        if (file_exists($this->baseDir."/".$view.'.php')) {
            ob_start();
            return True;
        } else {
            return False;
        }
    }

    /**
     * Render or redirection to view
     *
     * @param $viewName is view filename
     */
    public function load($viewName, array $varArray = array(), $extra = null, $prefix = null)
    {
        if ($this->variables != null) {
            extract($this->variables);
        }

        if (count($varArray) > 0) {
            $this->data = $varArray;
        }

        if (count($varArray > 0)) {
            if ($extra != null) {
                if ($prefix != null) {
                    extract($this->data, $extra, $prefix);
                } else {
                    extract($this->data, $extra);
                }
            } else {
                extract($this->data);
            }
        }

        if (file_exists($this->baseDir."/".$viewName.'.php')) {
            ob_start();
            require($this->baseDir."/".$viewName.'.php');
            $output = ob_get_contents();

            return $output;
            ob_end_clean();
        } else {
            echo "None to include";
        }
    }

    /**
     * Render view location in public directory
     *
     * @param string
     */
    public function responseDefault($response, array $varArray = array())
    {
        if (count($varArray) > 0) {
            extract($varArray);
        }

        require(ROOT_DIR.'/simplex/systemplate/response/'.$response.'.php');
    }
}
