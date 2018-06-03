<?php

namespace Database\Driver;

use PDO;
use Libraries\Monolog\Logger;
use Libraries\Monolog\Handler\StreamHandler;

/**
 * PdoDB class.
 *
 * @category  Simplification of Database Access Use PDO Ekstension
 *
 * @author    Hafidz Jazuli Luthfi <hafidz@olacode.com>
 * @copyright Copyright (c) 2015
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU Public License
 *
 * @version   0.1
 */
class PdoDb
{
    /**
     * PDO object.
     *
     * @var object
     */
    public $pdo;

    /**
     * Database Serial Name.
     *
     * @var string
     */
    private $dsn;

    /**
     * Database credential.
     *
     * @var string
     */
    private $username;
    private $password;

    /**
     * Condition of database excetution.
     *
     * @var bool
     */
    private $connected = false;

    /**
     * Query statement.
     *
     * @var string
     */
    private $queryStatement;

    /**
     * Parameters of query.
     *
     * @var array
     */
    private $parameters;

    /**
     * Fetch column.
     *
     * @var int
     */
    public $fetchColumn;

    /**
     * Last prepared query
     *
     * @var last prepared PDO query
     */
    public $lastQuery;

    /**
     * Number of rows.
     *
     * @var int
     */
    public $numRows;

    /**
     * Number of column.
     *
     * @var int
     */
    public $numColumns;

    /**
     * contains error messages
     *
     * @var str
     */
    public $error;

    /**
     * exceptionLog.
     *
     * @var object
     */
    private $log;

    /**
     * @param string $dsn
     * @param string $username
     * @param string $password
     * @param object $log
     */
    public function __construct($dsn, $username, $password)
    {
        $this->dsn = $dsn;
        $this->username = $username;
        $this->password = $password;
        $this->connect();
        $this->parameters = array();
    }

    /**
     * Conection to database.
     */
    private function connect()
    {
        try {
            $this->pdo = new PDO(
                $this->dsn,
                $this->username,
                $this->password,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
            );

            # Enable to catch error and exception .
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            # Disable emulation of prepared statements, use REAL prepared statements instead.
            $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            # Connection succeeded, set the boolean to true.
            $this->connected = true;
        } catch (\PDOException $e) {
            # Write into log
            $this->exceptionLog($e);
            die();
        }
    }

    /**
     * Close the database connection.
     */
    public function closeConnection()
    {
        $this->pdo = null;
    }

    /**
     * @void
     *
     * All database query call use this method, before retriev result
     * This method do:
     * 1. Prepare the query statements.
     * 2. Use bindParam to catch the query statement's parameter.
     * 3. Execute the query.
     *
     * @param string $query
     * @param string $parameters
     */
    private function init($query, $parameters = '')
    {
        if (!$this->connected) {
            $this->connect();
        }

        $success = false;

        try {
            // Prepare statement
            $this->queryStatement = $this->pdo->prepare($query);
            // Save last prepared statement
            $this->lastQuery = $this->queryStatement;
            // Bind each values
            $this->bindMore($parameters);
            if (!empty($this->parameters)) {
                foreach ($this->parameters as $param) {
                    $parameters = explode('[---]', $param);
                    $this->queryStatement->bindParam(
                        $parameters[0],
                        $parameters[1]
                    );
                }
            }

            $this->queryStatement->execute();
            $success = true;
        } catch (\PDOException $e) {
            # Write into log
            $this->error = $this->errorMessage($e);
            $this->exceptionLog($e);
        }

        // Reset the parameters
        $this->parameters = array();

        return $success;
    }

    public function bind($columnName, $value)
    {
        $param = ':'.$columnName.'[---]'.utf8_encode($value);
        $this->parameters[sizeof($this->parameters)] = $param;
    }

    public function bindMore($columnAndValues)
    {
        if (empty($this->parameters) && is_array($columnAndValues)) {
            $columns = array_keys($columnAndValues);
            foreach ($columns as $key => &$column) {
                $this->bind($column, $columnAndValues[$column]);
            }
        }
    }

    public function query($query, $params = null, $fetchMode = PDO::FETCH_ASSOC)
    {
        $query = trim($query);
        $execution = $this->init($query, $params);

        if ($execution) {
            $rawStatement = explode(' ', $query);
            $statement = strtolower($rawStatement[0]);

            if ($statement === 'select' || $statement === 'show') {
                return $this->queryStatement->fetchAll($fetchMode);
            }
        }

        return $execution;
    }

    /**
     * Last perpared query
     *
     * @return PDO query
     */
    public function executedQuery()
    {
        return $this->queryStatement;
    }

    /**
     *  Returns the last inserted id.
     *
     *  @return string
     */
    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }

    public function column($query, $params = null)
    {
        $this->init($query, $params);
        $colums = $this->queryStatement->fetchAll(PDO::FETCH_NUM);
        $column = null;

        foreach ($colums as $cells) {
            $colum[] = $cells[0];
        }

        return $column;
    }

    public function row($query, $params = null, $fetchMode = PDO::FETCH_ASSOC)
    {
        return $this->queryStatement->fetch($fetchMode);
    }

    public function single($query, $params = null)
    {
        $this->init($query, $params);

        return $this->queryStatement->fetchColumn();
    }

    public function errorMessage($exception)
    {
        $err = "<div class='error_main'>";
            $err.= "<br /><b>Error Time :</b>" . date('Y-m-d H:i:s A');
            $err.= "<br /><b>Error Code :</b>" . $exception->getCode();
            $err.= "<br /><b>Error Message :</b>" . $exception->getMessage();
            $err.="<br /><b>Error File :</b>" . $exception->getFile();
            $err.="<br /><b>Error File Line :</b>" . $exception->getLine();
             $err.="<br /><b>Error Trace :</b><br />" . preg_replace("/\n/", '<br>', $exception->getTraceAsString());
        $err.= "</div>";
    }

    private function exceptionLog($exception, $showMsg = false)
    {
        # Write into log
        $exceptionMsg = "Error Code: ".$exception->getCode()."\r\n";
        $exceptionMsg.= "Error Message ".$exception->getMessage()."\r\n";
        $exceptionMsg.= "Error File: ".$exception->getFile()."\r\n";
        $exceptionMsg.= "Error File Line: ".$exception->getLine()."\r\n";
        $exceptionMsg.= "Error Trace: ". $exception->getTraceAsString();
        \Core\logger::write($exceptionMsg);

        if ($showMsg) {
            $message = 'Unhandled Exception. <br />';
            $message .= '<br /> You can find the error back in the log.';
            echo $message;
        }
    }
}
