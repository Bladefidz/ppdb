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

/*
 * Simplex Class Autoloader using spl_autoload_register PSR-4
 *
 * @author  Hafidz Jazuli Luthfi - hafidz@olacode.com
 */
spl_autoload_register(function ($class) {
    // project-specific namespace prefix
    $register = array(
        'Core\\' => ROOT_DIR.'/simplex/core/',
        'Database\\' => ROOT_DIR.'/simplex/database/',
        'Libraries\\' => ROOT_DIR.'/simplex/libraries/',
        'Helpers\\' => ROOT_DIR.'/simplex/helpers/',
        'Controllers\\' => ROOT_DIR.'/application/controllers/',
        'Models\\' => ROOT_DIR.'/application/models/',
        'Views\\' => ROOT_DIR.'/application/views/',
    );

    // Loop each namespace prefix
    foreach ($register as $prefix => $baseDir) {
        $prefixLen = strlen($prefix);

        // echo "Prefix:".$prefix."<br/>";
        // echo "Class:".$class.'</br>';
        // does the class use the namespace prefix?
        if (strncmp($prefix, $class, $prefixLen) !== 0) :
            // no, move to the next registered autoloader
            continue;
        endif;

        // get the relative class name
        $relativeClass = substr($class, $prefixLen);

        // replace the namespace prefix with the base directory, replace namespace
        // separators with directory separators in the relative class name, append
        // with .php
        $file = $baseDir.str_replace('\\', '/', $relativeClass).'.php';
        // echo "File:".$file.'</br>';

        // if the file exists, require it
        if (file_exists($file)) {
            require $file;
        }
    }
});

// Call Config as object to construct requirements
$conf = new Config();

// Do configure all requirements
date_default_timezone_set($conf->readMainConfig()['date_time']);
define('DEFAULT_CONTROLLER', $conf->readMainConfig()['default_controller']);
define('DEFAULT_METHOD', $conf->readMainConfig()['default_method']);
define('HOME', $conf->readMainConfig()['home']);
define('ASSETS_DIR', HOME."/".$conf->readMainConfig()['assets_dir']);
define('SYS_TEMPLATES_DIR', HOME.'/simplex/systemplate');
define('SYS_ASSETS', HOME.'/simplex/systemplate/assets/');

//turn on output buffering
ob_start();

//define default routes
Router::get('', 'Controllers\\'.DEFAULT_CONTROLLER.'@'.DEFAULT_METHOD);
