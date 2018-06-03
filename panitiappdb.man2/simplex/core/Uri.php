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
 * Uri Class
 *
 * @author  Hafidz Jazuli Luthfi - hafidz@olacode.com
 */
class Uri
{
    /**
     * List of URI segments.
     *
     * Starts at 1 instead of 0.
     *
     * @var array
     */
    public $segments = array();

    public function segments($index = '')
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $this->segments = explode('/', $uri);

        return $this->segments[$index];
    }

    /**
     * Header Redirect.
     *
     * Header redirect in two flavors
     * For very fine grained control over headers, you could use the Output
     * Library's set_header() function.
     *
     * @param string $uri    URL
     * @param string $method Redirect method
     *                       'auto', 'location' or 'refresh'
     * @param int    $code   HTTP Response status code
     */
    public function redirect($uri, $method = 'auto', $code = null)
    {
        // IIS environment likely? Use 'refresh' for better compatibility
        if ($method === 'auto'
            && isset($_SERVER['SERVER_SOFTWARE'])
            && strpos($_SERVER['SERVER_SOFTWARE'], 'Microsoft-IIS') !== false
        ) {
            $method = 'refresh';
        } elseif ($method !== 'refresh' && (empty($code) or !is_numeric($code))) {
            if (isset($_SERVER['SERVER_PROTOCOL'], $_SERVER['REQUEST_METHOD'])
                && $_SERVER['SERVER_PROTOCOL'] === 'HTTP/1.1'
            ) {
                $code = ($_SERVER['REQUEST_METHOD'] !== 'GET')
                    ? 303    // reference: http://en.wikipedia.org/wiki/Post/Redirect/Get
                    : 307;
            } else {
                $code = 302;
            }
        }

        switch ($method) {
            case 'refresh':
                header('Refresh:0;url='.$uri);
                break;
            default:
                header('Location: '.$uri, true, $code);
                break;
        }
        exit;
    }

    /**
     * [segments description]
     * @return [type] [description]
     */
    public function segment()
    {
        // $parsed = parse_url($url);
        // $path = $parsed['path'];
        // $path_parts = explode('/', $path);

        $_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
        
        return $_SERVER['REQUEST_URI'];
    }
}
