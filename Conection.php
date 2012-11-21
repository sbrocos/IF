<?php
namespace ICHI;

use Mysqli;

/**
 *
 * @author Sergio
 *
 */
abstract class IF_DBCONECTION
{
    // TODO - Insert your code here

    protected $db;
    protected $_name;
    private $_path;

    /**
     */
    protected function connect()
    {
        $this->_path = realpath(dirname(__FILE__));

        $config = new IF_CONFIG();
        $dbData = $config->getDatabaseConf();

        if ($dbData->type === "mysql") {
            require_once $this->_path . '/DBCLASS/mysql.php';
            $this->db = new IF_MYSQL($dbData);
        } else {
            //todo gestionar ERROR
            die("ERROR: Ichi Framework, sólo está disponible para usar Mysql, revise su archivo de configuración.");
        }
    }

    protected function query()
    {

    }
    protected function select()
    {
        require_once $this->_path . '/DBCLASS/Select.php';

        if (isset($this->_name)) {
            $select = new IF_SELECT($this->_name);
        } else {
            $select = new IF_SELECT();
        }



        return $select;
    }

    protected function insert()
    {
        require_once $this->_path . '/DBCLASS/Insert.php';

        if (isset($this->_name)) {
            $insert = new IF_INSERT($this->_name);
        } else {
            $insert = new IF_INSERT();
        }

        return $insert;
    }


    protected function run($query)
    {
        $result = $this->db->query($query->getCode());
        return $result;
    }

    /**
     */
    function __destruct ()
    {

        // TODO - Insert your code here
    }
}

?>