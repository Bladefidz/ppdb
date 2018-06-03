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
 * Simplex Application Class
 *
 */
class Application
{
    public function __construct()
    {
        $this->set_reporting();
        $this->remove_magic_quotes();
        $this->unregister_globals();
    }

    private function set_reporting()
    {
        if (DEVELOPMENT_ENVIRONMENT === true) {
            error_reporting(E_ALL);
            ini_set('display_errors', 'On');
            ini_set('error_log', ROOT_DIR.'/tmp/logs/error.log');
        } else {
            ini_set('display_errors', 'Off');
            ini_set('log_errors', 'On');
            ini_set('error_log', ROOT_DIR.'/tmp/logs/error.log');
        }
    }

    public function clean($input)
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

    private function strip_slashes_deep($value)
    {
        // $value = is_array($value) ? array_map(array($this, 'strip_slashes_deep'), $value) : stripslashes($value);
        $value = $this->clean($value);

        return $value;
    }

    private function remove_magic_quotes()
    {
        if (get_magic_quotes_gpc()) {
            $_GET = $this->strip_slashes_deep($_GET);
            $_POST = $this->strip_slashes_deep($_POST);
            $_COOKIE = $this->strip_slashes_deep($_COOKIE);
        }
    }

    private function unregister_globals()
    {
        if (ini_get('register_globals')) {
            $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
            foreach ($array as $value) {
                foreach ($GLOBALS[$value] as $key => $var) {
                    if ($var === $GLOBALS[$key]) {
                        unset($GLOBALS[$key]);
                    }
                }
            }
        }
    }
}
