<?php

namespace Database;

require_once __DIR__.'/drivers/pdo/PdoUtil.php';
require_once __DIR__.'/drivers/mysqli/MysqliDb.php';

use Database\Driver\PdoUtil;
use Database\Driver\MysqliDb;

/**
 * DB class.
 */
class DB
{
    /**
     * Database driver object.
     *
     * @var object
     */
    protected $db;

    /**
     * Database configuration.
     *
     * @var array
     */
    private $dbConfig;

    /**
     * Container for database fetch result.
     *
     * @var array
     */
    public $result;

    /**
     * Default constructor.
     *
     * 1. Initialize Log class.
     * 2. Initialize database dbConfig.
     * 3. Recieve connections.
     */
    public function __construct($dbConfig = null)
    {
        $this->result = new DBResult();
        $this->dbConfig = $dbConfig;
        $this->initialize();
    }

    /**
     * @void
     *
     * Initialize database configuration
     */
    private function initialize()
    {
        // If dbConfig not set, populate configuration by default path
        if ($this->dbConfig === null) {
            $this->dbConfig = parse_ini_file(
                dirname(__FILE__).'/../../dbConfig/database.ini.php'
            );
        }

        if ($this->dbConfig['dsn'] === '') {
            $this->dbConfig['dsn'] = strtolower(
                $this->dbConfig['dbtype'].':dbname='.
                $this->dbConfig['dbname'].';host='.
                $this->dbConfig['dbhost']
            );

            if ($this->dbConfig['port'] != '') {
                $this->dbConfig['dsn'].';port='.$this->dbConfig['port'];
            }
        }

        if (strtolower($this->dbConfig['dbdriver']) === 'pdo') {
            $this->db = new PdoUtil(
                $this->dbConfig['dsn'], $this->dbConfig['dbusername'],
                $this->dbConfig['dbpassword']
            );
        } elseif (strtolower($this->dbConfig['dbdriver']) === 'mysqli') {
            require_once __DIR__.'/drivers/pdo/MysqliDb.php';

            $this->db = new MysliDb(
                $this->dbConfig['dbhost'], $this->dbConfig['dbusername'],
                $this->dbConfig['dbpassword'], $this->dbConfig['dbname'],
                $this->dbConfig['port']
            );
        }
    }
}

/* End of file DB.php */
