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
 * Simplex Config class
 */
class Config
{
    /**
     * Config file basepath
     *
     * @var constant
     */
    const CONF_PATH = "/../../application/config/";

    /**
     * Location of database configuration
     *
     * @var string
     */
    private $dbConf;

    /**
     * Location of main configuration
     *
     * @var string
     */
    private $mainConf;

    /**
     * Location of route configuration
     *
     * @var string
     */
    private $routeConf;

    function __construct()
    {
        $this->dbConf = self::CONF_PATH."database.ini.php";
        $this->mainConf = self::CONF_PATH."main.ini.php";
        $this->routeConf = self::CONF_PATH."routes.ini.php";
    }

    /**
     * Read database configuration file
     *
     * @return string - database configuration
     */
    public function readDbConfig()
    {
        return parse_ini_file(dirname(__FILE__).$this->dbConf);
    }

    /**
     * Read path configuration file
     *
     * @return string - path of desired location
     */
    public function readPathConfig()
    {
        return parse_ini_file(dirname(__FILE__).$this->pathConf);
    }

    /**
     * Read main configuration file
     *
     * @return string
     */
    public function readMainConfig()
    {
        return parse_ini_file(dirname(__FILE__).$this->mainConf);
    }

    /**
     * Read route configuration
     *
     * @return string
     */
    public function readRouteConfig()
    {
        return parse_ini_file(dirname(__FILE__).$this->routeConf);
    }

    /**
     * Read costum or user defined configuration file
     *
     * @param string - filename of costum configuration
     * @return string
     */
    public function readCostumConfig($filename)
    {
        return parse_ini_file(dirname(__FILE__).$filename);
    }
}


/* End of Config.php */
