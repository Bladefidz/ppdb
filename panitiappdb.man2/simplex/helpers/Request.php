<?php
namespace Helpers;

/**
* Input class
*/
class Request
{
    /**
     * [input description]
     * @param  [type] $key [description]
     * @param  string $val [description]
     * @return [type]      [description]
     */
    public function input($key, $val = "")
    {
        if ($val != "") {
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $this->get($key);
            } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
                $this->post($key);
            }
        } else {
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $_GET[$key] = $val;
                return $_GET[$key];
            } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
                $_POST[$post] = $val;
                return $_POST[$key];
            }
        }
    }

    /**
     * [has description]
     * @return boolean [description]
     */
    public static function has($key)
    {
        $isset = false;

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if(isset($_GET[$key])) {
                $isset = true;
            }
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST[$key])) {
                $isset = true;
            }
        }

        return $isset;
    }

    /**
     * [all description]
     * @return [type] [description]
     */
    public static function all()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            return filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
            return filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        } else {
            return null;
        }
    }

    /**
     * [clean description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    private function clean($data)
    {
        $data = trim($data);
        $data = stripslashes($data);

        return htmlspecialchars($data);
    }

    /**
     * [post description]
     * @param  [type] $key [description]
     * @return [type]            [description]
     */
    public static function post($key)
    {
    	if (isset($_POST[$key])) {
            $data = trim($_POST[$key]);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
    	} else {
    		$data = null;
    	}
        
        return $data;
    }

    /**
     * [get description]
     * @param  [type] $key [description]
     * @return [type]            [description]
     */
    public static function get($key)
    {
        if (isset($_GET[$key])) {
            $data = trim($_GET[$key]);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);  
        } else {
            $data = null;
        }
        
        return $data;
    }
}
