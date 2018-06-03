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

/*
 * error class - calls a 404 page
 * Developed from David Carr - dave@simplemvcframework.com
 *
 * @author Hafidz Jazuli Luthfi
 */
class Error extends \Core\Controller
{
    /**
     * $error holder
     * @var string
     */
    private $error = null;

    /**
     * save error to $this->_error
     * @param string $error
     */
    public function __construct($error)
    {
        parent::__construct();

        $this->error = $error;
    }

    /**
     * load a 404 page with the error message
     */
    public function index()
    {
        header("HTTP/1.0 404 Not Found");

        $data['error'] = $this->error;

        $this->view->responseDefault('404', $data);
    }
}
