<?php
namespace Models;

/**
 * UserModel class
 */
class UserModel extends \Core\Model
{
    /**
     * Username.
     *
     * @var string
     */
    private $username;

    /**
     * Password.
     *
     * @var string
     */
    private $password;

    /**
     * User access power.
     *
     * @var integer
     */
    private $power;

    /**
     * Ip address.
     *
     * @var string
     */
    private $ip;

    /**
     * Temporary of fetched datasiswa
     *
     * @var array
     */
    private $tmp = array();

    /**
     * Login status.
     *
     * @var bool
     */
    public $loggedIn;

    /**
     * Error message.
     *
     * @var string
     */
    public $errorMsg;

    function __construct()
    {
        parent::__construct();

        $this->db->table = 'ppdb_user';
        $this->db->pk = 'uid';
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

    private function usernameAvailable($username)
    {
        if (ctype_alnum($username)) {
            $username = $this->clean($username);

            // Fetch data
            $query = 'SELECT username FROM ppdb_user WHERE username = :usr';
            $param = array('usr' => $username);
            $getUsername = $this->db->query($query, $param);

            if ($this->db->numRows == 0) {
                return true;
            } else {
                $this->errorMsg = 'Username not available';
                return false;
            }
        } else {
            $this->errorMsg = 'Illegal username';
            return false;
        }
    }

    private function getIpAddress()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            //to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }

    public function newUser($username, $password, $access)
    {
        // Securing password using hash encryption
        $hashedPass = password_hash($password, PASSWORD_DEFAULT);

        if ($this->usernameAvailable($username)) {
            // Cleaning string by force it into array type
            $password = $this->clean($hashedPass);
            $access = $this->clean($access);
            $ip = $this->getIpAddress();

            // Insert data
            $query = 'INSERT INTO ppdb_user(username, password, access, register_date, ip_when_registered)'.
                     ' VALUES(:usr, :pass, :acs, :rd, :ip)';
            $param = array(
                'usr' => $username,
                'pass' => $this->clean['password'],
                'acs' => $access,
                'rd' => date('Y-m-d H:i:s'),
                'ip' => $this->clean['ip'],
            );
            $insert = $this->db->query($query, $param);

            if ($insert) {
                return true;
            }
        } else {
            return false;
        }
    }

    public function verify($username, $password, $remember = false)
    {
        if (ctype_alnum($username)) {
            // Cleaning string by force it into array type
            $username = $this->clean($username);
            $password = $this->clean($password);

            // Fetch data
            $query = 'SELECT uid, username, password FROM ppdb_user'.
                ' WHERE username = :usr LIMIT 1';
            $param = array('usr' => $username);
            $select = $this->db->query($query, $param);

            if (count($select) == 1) {
                if (password_verify($this->clean['password'], $select[0]['password'])) {
                    $_SESSION['pendf_session'] = $select[0]['uid'];
                    $_SESSION['username'] = $select[0]['username'];
                    return true;
                }
            } else {
                return false;
            }
        }
    }

    public function verified($sessionRaw)
    {
        // Update data
        $query = 'UPDATE ppdb_user SET ip_roaming = :ip, phpssid = :phpssid, last_log_in = :dt'.
            ' WHERE uid = :uid';
        $param = array(
            'ip' => $this->clean($this->getIpAddress()),
            'phpssid' => $sessionRaw,
            'dt' => date('Y-m-d H:i:s'),
            'uid' => $_SESSION['pendf_session']
        );
        $update = $this->db->query($query, $param);

        if ($update) {
            return true;
        } else {
            return false;
        }
    }
}
