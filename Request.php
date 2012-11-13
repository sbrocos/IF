<?php
namespace ICHI;

/**
* Clase que gestiona el request.
*
* Clase que gestiona el $_POST y el $_GET. Para que desde elos controladores pueda
*
* @category   IF
* @package    IF_REQUEST
* @copyright  Copyright (c) 2012 Sergio Brocos (http://ichiframework.es)
* @license    http://ichiframework.es/license   BSD License
* @author     Sergio
* @version    V.0.1
* @since      Class available since Release V.0.1
*/

class IF_REQUEST
{
    /**
     * Variable que contiene el REQUEST, el conjunto de las variables GET y POST recogidas.
     * @var array
     */
    protected $_request;

    /**
     * Función del constructor de la clase.
     * une en una variable el POST y el GET.
     */
    public function __construct()
    {
        $this->_request = array_merge_recursive($_GET, $_POST);
    }

    /**
     * Función que devuelve el Request entero.
     */
    public function getParams()
    {
        return $this->_request;
    }

    /**
     * Función que nos devuelve el valor de un paramtro pasado por GET o POST concreto.
     * @param string $key
     * @return string:|boolean
     */
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

    /**
     * Función que nos devuelve un boolean si la $key coicide con un parámetro suministrado por el POST
     * @param string $key
     * @return boolean
     */
    public function isPost($key)
    {
        //TODO escribir código pertinente
    }

    /**
     * Función que nos devuelve un boolean si la $key coicide con un parámetro suministrado por el GET
     * @param string $param
     * @return boolean
     */
    public function isGet($key)
    {
        //TODO escribir código pertinente
    }

    /**
     * Función que devuelve sólo los parámetros asociados al POST.
     * @return array:|boolean
     */
    public function getPost()
    {
        //TODO escribir código pertinente
    }

    /**
     * Función que devuelve sólo los parámetros asociados al GET.
     * @return array:|boolean
     */
    public function getGet()
    {
        //TODO escribir código pertinente
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
