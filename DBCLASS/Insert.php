<?php
namespace ICHI;

/**
* Short description for class classname
*
* Long description for class (if any)...
*
* @category   IF
* @package    project
* @copyright  Copyright (c) 2012 Sergio Brocos (http://ichiframework.es)
* @license    http://ichiframework.es/license   BSD License
* @author     Sergio
* @version    Release: @package_version@ $Id$
* @since      Class available since Release V.0
*/

class IF_INSERT
{
    private $_table;
    private $_values;


    public function __construct($table = null)
    {
        if ($table) {
            $this->_table = $table;
        }
    }

    public function values( $values )
    {
        if (is_array($values)) {
            $this->_values = $values;
        }
    }

    public function getCode()
    {
        $insert = " INSERT INTO ";
        $insert .= "{$this->_table}";

        if (is_array($this->_values)) {
            $count  = count($this->_values);
            $cont = 1;
            $fields = '( ';
            $values = 'VALUES ( ';
            foreach ($this->_values as $key=>$val) {
                if ($cont>1) {
                    $fields .= ", ";
                    $values .= ", ";
                }
                $fields .= "$key";
                $values .= "'$val'";
                $cont++;
            }
            $fields .= ') ';
            $values .= ') ';

            $insert .= $fields;
            $insert .= $values;

            return $insert;
        } else {
            die('ERROR: datos incorrectos');
            //Todo gestionar errores
        }

        return false;
    }
}
