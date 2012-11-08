<?php
/**
 * Clase 'Padre' para los controladores
 * @author Sergio
 * @version v.0.2
 */

abstract class IF_CONTROLLER
{
    private $_renderLayout;
    private $_View;
    private $_Request;
    private $_noRender;

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
        $data = $this->$action();
        //renderizamos la vista
        if (!$this->_noRender) {
            $View->renderPHP($data, $this->_renderLayout);
        } else {
            $View->renderAjax($data);
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
}