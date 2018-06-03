<?php

namespace Database;

require_once __DIR__.'/drivers/pdo/PdoUtil.php';
require_once __DIR__.'/drivers/mysqli/MysqliDb.php';

use Core\Logger;
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
     * Object for logging exception.
     *
     * @var object
     */
    private $log;

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
        $this->log = new Logger();
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
                $this->dbConfig['dbpassword'], $this->log
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

    /**
     * Save any error output to log file.
     *
     * @param string $type
     * @param string $message
     *
     * @return string contains log message
     */
    private function logging($type = null, $message)
    {
        $exception = 'Unhandled Exception. <br />';
        $exception .= $message;
        $exception .= '<br /> You can find the error back in the log.';

        # Write into log
        if (!empty($type)) {
            $message = strtoupper($type).' : '.$message;
        }

        $this->log->write($message);

        return $exception;
    }
}

/* End of file DB.php */
