<?php
namespace ICHI;

/**
* Clase abstracta padre de los controlladres.
*
* Clase abstracta, que será de padre de todos los controladores de la aplicación.
*
* @category   IF
* @package    IF_CONTROLLER
* @copyright  Copyright (c) 2012 Sergio Brocos (http://ichiframework.es)
* @license    http://ichiframework.es/license   BSD License
* @author     sbrocos
* @version    V.0.1
* @since      Class available since Release V.0.1
*/

abstract class IF_CONTROLLER
{
    /**
     *
     * @var boolean
     */
    private $_renderLayout;
    /**
     *
     * @var IF_VIEW object
     */
    private $_View;
    /**
     *
     * @var IF_REQUEST object
     */
    private $_Request;
    /**
     *
     * @var boolean
     */
    private $_noRender;

    /**
     *
     * @var array;
     */
    private $_data;

    /**
     * Función que ejecuta la action de la clase(contolador) hija
     * @param clase hija $Instance
     * @param IF_VIEW $View
     * @param string $action
     */
    public function exec($View, $action)
    {
        $this->_Request = new IF_REQUEST();
        $this->_renderLayout = true;
        $this->_View = $View;
        $this->_noRender = false;
        //llamamos a la action del Controller Hijo
        $this->_data = $this->$action();
        //renderizamos la vista
        if (!$this->_noRender) {
            $View->renderPHP($this->_data, $this->_renderLayout);
        } else {
            $View->renderAjax($this->_data);
        }
    }

    /**
     * Funcion que deniega el renderizado del Layout
     */
    public function noLayout()
    {
        $this->_renderLayout = false;
    }

    /**
     * Funcion que establece el Layout a usar por la APP.
     * @param string $name
     */
    public function setLayout($layoutName)
    {
        $this->_View->setLayout($layoutName);
    }

    /**
     * Función que establece una Vista especificada por el usuario.
     * @param string $viewName
     */
    public function setView($viewName)
    {
        $this->_View->setView($viewName);
    }

    /**
     * Función que establece comportamiento para Ajax.
     * Implica que desactiva el layout y lo vincula con una vista si se define, sino no.
     * @param string $viewName
     */
    public function ajax($viewName = null)
    {
        $this->_renderLayout = false;
        $this->_noRender = true;
        if ($viewName) {
            $this->_View->setView($viewName);
        }
    }

    public function getParams()
    {
        return $this->_Request->getParams();
    }

    public function getParam($key)
    {
        return $this->_Request->getParam($key);
    }

    /**
     * Funtion que nos dice si tenemos o no parámetros GET o POST
     * @return boolean
     */
    public function haveRequest()
    {
        return $this->_Request->haveRequest();
    }

    /**
     * Función que pasa parámetros para el Layout
     * Cuando queremos que pasar una variable para usar en el layout, se seteará con esta función.
     * @params array $params
     */
    public function passToLayout($params)
    {
        if ( is_array($params)) {
            $this->_View->setDataLayout($params);
        } else {
            //TODO error
        }
    }
 }