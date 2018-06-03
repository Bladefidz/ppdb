<?php

namespace Helpers;

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
 * FormDesigner class
 * Inspired from CodeIgniter form_helper.php
 *
 * @author  Hafidz Jazuli Luthfi - hafidz@olacode.com
 */
class FormHelper
{
    private $conf;
    private $choices;
    private $combo;

    public function __construct() {
        $this->conf = new \Core\Config();
    }

    /**
     * Open form to start from decralation
     *
     * @access public
     * @param string - form action
     * @param array - form attributes
     * @param array - hide the form elements
     */
    public function formOpen($action = '', $attributes = array(), $hidden = array())
    {
        // If action is not full URI, then changed into full URI
        // If action not set, then set it to current URI
        if ($action && strpos($action, '://') === false) {
            $action = htmlspecialchars(HOME."/".$action);
        } elseif ($action === '') {
            $action = htmlspecialchars('#');
        }

        if ($attributes === '') {
            $attributes = 'method="post"';
        }

        $form = '<form action="'.$action.'"';
        $form .= $this->attributestoString($attributes, true);
        $form .= '>';

        return $form;
    }

    /**
     * Close the form decralation
     *
     * @access public
     * @param string
     * @param string
     */
    public function formClose($extra='')
    {
        return "</form>".$extra;
    }

    /**
     * Attributes To String
     *
     * Helper function used by some of the form helpers
     *
     * @access  private
     * @param   mixed
     * @param   bool
     * @return  string
     */
    public function attributestoString($attributes, $formtag = false)
    {
        if (is_string($attributes) AND strlen($attributes) > 0)
        {
            if ($formtag == TRUE AND strpos($attributes, 'method=') === FALSE)
            {
                $attributes .= ' method="post"';
            }

            if ($formtag == TRUE AND strpos($attributes, 'accept-charset=') === FALSE)
            {
                $attributes .= ' accept-charset="'.strtolower($this->conf->readDbConfig()['charset']).'"';
            }

        return ' '.$attributes;
        }

        if (is_object($attributes) AND count($attributes) > 0)
        {
            $attributes = (array)$attributes;
        }

        if (is_array($attributes) AND count($attributes) > 0)
        {
            $atts = '';

            if ( ! isset($attributes['method']) AND $formtag === TRUE)
            {
                $atts .= ' method="post"';
            }

            if ( ! isset($attributes['accept-charset']) AND $formtag === TRUE)
            {
                $atts .= ' accept-charset="'.strtolower($this->conf->readDbConfig()['charset']).'"';
            }

            foreach ($attributes as $key => $val)
            {
                $atts .= ' '.$key.'="'.$val.'"';
            }

            return $atts;
        }
    }
}
