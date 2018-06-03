<?php

namespace Database\Driver;

require_once __DIR__.'/PdoDb.php';

/**
 * PdoUtil class.
 */
class PdoUtil extends \Database\Driver\PdoDb
{
    /**
     * Getter and setter variable.
     *
     * @var array
     */
    public $variables;

    /**
     * Table name.
     *
     * @var string
     */
    public $table;

    /**
     * Table primary key.
     *
     * @var string
     */
    public $pk;

    public function __construct($dsn, $username, $password, $data = array())
    {
        parent::__construct($dsn, $username, $password);

        $this->variables = $data;
    }

    public function __set($name, $value)
    {
        if (strtolower($name) === $this->pk) {
            $this->variables[$this->pk] = $value;
        } else {
            $this->variables[$name] = $value;
        }
    }

    public function __get($name)
    {
        if (is_array($this->variables)) {
            if (array_key_exists($name, $this->variables)) {
                return $this->variables[$name];
            }
        }

        $trace = debug_backtrace();
        trigger_error(
            'Undefined property via __get(): '.$name.
            ' in '.$trace[0]['file'].
            ' on line '.$trace[0]['line'],
            E_USER_NOTICE
        );

        return;
    }

    public function from($tableName)
    {
        $this->table = $tableName;
    }

    public function into($tableName)
    {
        $this->table = $tableName;
    }

    public function where($value)
    {
        $this->variables[$name] = $value;
    }

    public function save($id = '0')
    {
        $this->variables[$this->pk] = (empty($this->variables[$this->pk])) ? $id : $this->variables[$this->pk];

        $fieldsvals = '';
        $columns = array_keys($this->variables);

        foreach ($columns as $column) {
            if ($column !== $this->pk) {
                $fieldsvals .= $column.' = :'.$column.',';
            }
        }

        $fieldsvals = substr_replace($fieldsvals, '', -1);

        if (count($columns) > 1) {
            $sql = 'UPDATE '.$this->table.' SET '.$fieldsvals.' WHERE '.$this->pk.'= :'.$this->pk;

            return $this->query($sql, $this->variables);
        }
    }

    public function create()
    {
        $bindings = $this->variables;

        if (!empty($bindings)) {
            $fields = array_keys($bindings);
            $fieldsvals = array(implode(',', $fields),':'.implode(',:', $fields));
            $sql = 'INSERT INTO '.$this->table.' ('.$fieldsvals[0].') VALUES ('.$fieldsvals[1].')';
        } else {
            $sql = 'INSERT INTO '.$this->table.' () VALUES ()';
        }

        return $this->query($sql, $bindings);
    }

    public function delete($id = '')
    {
        $id = (empty($this->variables[$this->pk])) ? $id : $this->variables[$this->pk];

        if (!empty($id)) {
            $sql = 'DELETE FROM '.$this->table.' WHERE '.$this->pk.'= :'.$this->pk.' LIMIT 1';

            return $this->query($sql, array($this->pk => $id));
        }
    }

    public function find($id = '')
    {
        $id = (empty($this->variables[$this->pk])) ? $id : $this->variables[$this->pk];

        if (!empty($id)) {
            $sql = 'SELECT * FROM '.$this->table.' WHERE '.$this->pk.'= :'.$this->pk.' LIMIT 1';
            $this->variables = $this->row($sql, array($this->pk => $id));
        }
    }

    public function get($limit = null)
    {
        if ($limit === null) {
            return $this->query('SELECT * FROM '.$this->table);
        } else {
            return $this->query('SELECT * FROM '.$this->table.' LIMIT '.$limit);
        }
    }

    public function all()
    {
        return $this->query('SELECT * FROM '.$this->table);
    }

    public function min($field)
    {
        if ($field) {
            return $this->single('SELECT min('.$field.')'.' FROM '.$this->table);
        }
    }

    public function max($field)
    {
        if ($field) {
            return $this->single('SELECT max('.$field.')'.' FROM '.$this->table);
        }
    }

    public function avg($field)
    {
        if ($field) {
            return $this->single('SELECT avg('.$field.')'.' FROM '.$this->table);
        }
    }

    public function sum($field)
    {
        if ($field) {
            return $this->single('SELECT sum('.$field.')'.' FROM '.$this->table);
        }
    }

    public function count($field)
    {
        if ($field) {
            return $this->single('SELECT count('.$field.')'.' FROM '.$this->table);
        }
    }

    public function countRows()
    {
        return $this->lastQuery->rowCount();
    }

    public function countColumn()
    {
        return $this->lastQuery->columnCount();
    }
}
