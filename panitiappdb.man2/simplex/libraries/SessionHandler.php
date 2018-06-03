<?php
namespace Libraries;

use Libraries\SecureSession;

/**
 * Session class
 */
class SessionHandler extends SecureSession
{

    /**
     * Session is was started or not
     *
     * @var bool
     */
    public $isStarted = false;

    public function __construct()
    {
        parent::__construct();

        if (!isset($_SESSION)) {
            $this->start();
        }
    }

    /**
     * Set temp system storage to save the session data and start session
     */
    public function start()
    {
        session_save_path(sys_get_temp_dir());
        session_start();

        $this->isStarted = true;
    }

    public function stop()
    {
        session_unset();
        session_destroy();

        $this->isStarted = false;
    }

    public function getSessionFile()
    {
        $sessionFile = sys_get_temp_dir().'/'.session_name().'_'.session_id();
        return file_get_contents($sessionFile);
    }

    public function check($data)
    {
        if (isset($_SESSION[$data])) {
            return true;
        }
    }

    public function insert($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function remove($key, $value, $all = false)
    {
        # code...
    }
}
