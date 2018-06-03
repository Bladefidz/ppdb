<?php

require_once __DIR__.'/../lib/database/DB.php';
require_once __DIR__.'/../lib/SecureSession.php';
require_once __DIR__.'/../lib/Security.php';

/**
 * Auth class.
 */
class Auth
{
    /**
     * Container for DB instance.
     *
     * @var object
     */
    private $db;

    /**
     * Data contains the result of query.
     *
     * @var array
     */
    private $data;

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
     * Cotain session path.
     *
     * @var string
     */
    private $sessionPath;

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

    public function __construct()
    {
        $this->db = new DB();
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
            $query = 'SELECT username FROM user WHERE username = :usr';
            $param = array('usr' => $username);
            $getUsername = $this->db->query($query, $param);

            if ($this->db->countRows() == 0) {
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
        if (!emptyempty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!emptyempty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            //to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }

    public function register($username, $password, $power)
    {
        // Securing password using hash encryption
        $hashedPass = password_hash($password, PASSWORD_DEFAULT);

        if ($this->usernameAvailable($username)) {
            // Cleaning string by force it into array type
            $password = $this->clean($hashedPass);
            $power = $this->clean($power);
            $ip = $this->getIpAddress();

            // Insert data
            $query = 'INSERT INTO user(username, password, power, ip_when_registered)'.
                     ' VALUES(:usr, :pass, :power, :ip)';
            $param = array(
                'usr' => $username,
                'pass' => $this->clean['password'],
                'power' => $this->clean['password'],
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

    public function startSession()
    {
        $this->sessionPath = sys_get_temp_dir();
        session_save_path($this->sessionPath);
        session_start();
    }

    private function readSessionFile()
    {
        $sessionFile = $this->sessionPath.'/'.session_name().'_'.session_id();

        return file_get_contents($sessionFile);
    }

    public function login($username, $password, $remember = false)
    {
        if (ctype_alnum($username)) {
            // Cleaning string by force it into array type
            $this->clean['username'] = $username;
            $this->clean['password'] = $password;
            $this->clean['ip'] = $this->getIpAddress();

            // Fetch data
            $query = 'SELECT uid, username, password FROM user'.
                ' WHERE username = :usr LIMIT 1';
            $param = array('usr' => $this->clean['username']);
            $select = $this->db->query($query, $param);

            if ($this->db->countRows() == 1) {
                if (password_verify($this->clean['password'], $select['password'])) {
                    $this->startSession();
                    $_SESSION['user_session'] = $select['uid'];
                    $_SESSION['username'] = $select['username'];

                    // Update data
                    $query = 'UPDATE user SET'.
                        ' ip_roaming = :ip, phpssid = :phpssid'.
                        ' WHERE uid = :uid';
                    $param = array(
                        'ip' => $this->clean['ip'],
                        'phpssid' => $this->readSessionFile(),
                        'uid' => $select['uid'],
                    );
                    $update = $this->db->query($query, $param);

                    if ($update == 1) {
                        return true;
                    } else {
                        return false;
                    }
                }
            } else {
                return false;
            }
        }
    }

    public function isLoggedin()
    {
        if (isset($_SESSION['user_session'])) {
            return true;
        }
    }

    public function redirect($uri = '')
    {
        return header('location: '.$uri);
    }

    public function logout($value = '')
    {
        // unset($_SESSION['user_session'], $_SESSION['username']);
        session_unset();
        session_destroy();

        return true;
    }
}

/* End of Auth.php */
