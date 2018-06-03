<?php
namespace Models;

/**
*
*/
class TestingModel extends \Core\Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function insert($key, $value) {
        $query = "INSERT INTO ppdb_test VALUES(:key, :value)";
        $param = array('key' => $key, 'value' => $value);
        return $this->db->query($query, $param);
    }

    public function verify($username, $password, $remember = false)
    {
        // Cleaning string by force it into array type
        $username = $this->clean($username);
        $password = $this->clean($password);

        // Fetch data
        $query = 'SELECT u.uid, u.username, u.password, u.role, ur.role_name '.
            'FROM ppdb_user as u JOIN ppdb_user_role as ur on(u.role=ur.role) '.
            'WHERE u.username = :usr';
        $param = array('usr' => $username);
        $select = $this->db->query($query, $param);
        if (count($select) === 1)
            $select = password_verify($password, $select[0]['password']);
        return $select;
    }

    private function clean($input)
    {
        if (is_array($input)) {
            foreach ($input as $key => $val) {
                $output[$key] = clean($val);
                // $output[$key] = $this->clean($val);
            }
        } else {
            $output = (string) $input;

            // if magic quotes is on then use strip slashes
            if (get_magic_quotes_gpc()) {
                $output = stripslashes($output);
            }

            // $output = strip_tags($output);
            $output = htmlentities($output, ENT_QUOTES, 'UTF-8');
        }

        // return the clean text
        return $output;
    }
}
