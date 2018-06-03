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
 * Model class.
 *
 * @author Hafidz Jazuli Luthfi - hafidz@olacode.com
 */
class Model extends \Database\DB
{
    /**
     * Config class object.
     *
     * @var object
     */
    private $conf;

    public function __construct()
    {
        $this->conf = new \Core\Config();
        $this->sessionHandler = new \Libraries\SessionHandler();

        parent::__construct($this->conf->readDbConfig());
    }

    public function load($modelName)
    {
        $model = "Models\\$modelName";
        return new $model;
    }
}
