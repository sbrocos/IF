<?php
/**
 * Clase 'Padre' para los controladores
 * @author Sergio
 * @version v.0.2
 */

class IF_CONTROLLER
{
    private $_renderLayout;
    private $_View;

    /**
     * Función que ejecuta la action de la clase(contolador) hija
     * @param clase hija $Instance
     * @param IF_VIEW $View
     * @param string $action
     */
    public function exec($Instance, $View, $action)
    {
        $this->_renderLayout = true;
        $this->_View = $View;
        //llamamos a la action del Controller Hijo
        $data = $Instance->$action();
        //renderizamos la vista
        $View->renderPHP($data, $this->_renderLayout);
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
}