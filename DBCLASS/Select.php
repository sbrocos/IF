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

class IF_SELECT
{
    private $_fields;
    private $_from;
    private $_where;
    private $_limit;
    private $_inner;
    private $_left;
    private $_right;
    private $_select;

    public function __construct( $from = null)
    {
        if ($from) {
            $this->_from = $from;
        }
    }

    public function from($from)
    {
        $this->_from = $from;
    }

    public function where($where)
    {
        $this->_where = $where;
    }

    public function limit($limit)
    {
        $this->_limit = $limit;
    }

    public function inner($table, $on)
    {
        $this->_inner = ' INNER JOIN ' . $table . ' ON ' . $on;
    }

    public function left($table, $on)
    {
        $this->_left = ' LEFT JOIN ' . $table . ' ON ' . $on;
    }

    public function right($table, $on)
    {
        $this->_right = ' RIGHT JOIN ' . $table . ' ON ' . $on;
    }

    public function getCode()
    {
        $select = " SELECT ";

        if ($this->_fields) {
            $select .= "{$this->_fields} ";
        } else {
            $select .= "* ";
        }

        $select .= "FROM {$this->_from} ";

        if ($this->_inner) {
            $select .= $this->_inner . ' ';
        }
        if ($this->_left) {
            $select .= $this->_left. ' ';
        }
        if ($this->_right) {
            $select .= $this->_right . ' ';
        }

        if ($this->_where) {
            $select .= " WHERE {$this->_where} ";
        }

        if ($this->_limit) {
            $select .= " LIMIT {$this->_limit} ";
        }

        return $select;
    }
}
