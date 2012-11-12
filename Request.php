<?php
/**
 * Clase para tratar el REQUEST
 * @author Sergio
 * @version v.0.2
 */
class IF_REQUEST
{
    protected $_request;

    public function __construct()
    {
        $this->_request = array_merge_recursive($_GET, $_POST);
    }

    public function getRequest()
    {

    }

    public function getParams()
    {
        return $this->_request;
    }

    public function getParam($key)
    {
        if ($key) {
            if (array_key_exists($key, $this->_request)) {
                return $this->_request[$key];
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function isPost($key)
    {

    }

    public function isGet($key)
    {

    }

    public function getPost()
    {

    }

    public function getGet()
    {

    }

    /**
     * Funcción que detemina si tenemos parametros en el REQUEST.
     * Se puede indicar si queremos que la comprobación sea en uno
     * de los dos métodos posibles, GET O POST.
     * @param string $type
     * @return boolean
     */
    public function haveRequest($type = null)
    {
        $type = strtolower($type);
        switch ($type) {
            case 'get':
                if ($_GET) {
                    return true;
                } else {
                    return false;
                }
                break;
            case 'post':
                if ($_POST) {
                    return true;
                } else {
                    return false;
                }
                break;
            default:
                if ($this->_request) {
                    return true;
                } else {
                    return false;
                }
                break;
        }
    }

}