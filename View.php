<?php
/**
 * Clase que gestiona las Vistas de la aplicación
 * @author sbrocos
 * @version v.0.2
 */
class IF_VIEW
{
    protected $_path;
    protected $_layout;
    protected $_pathView;
    protected $_params;

    /**
     * Constructor de la clase
     * @param array $parametros
     */
    public function __construct(array $parametros = null)
    {
        $this->_gestionError($parametros);

        $this->_path = APP_PATH . '/main/views/' . $parametros['controller'];

        foreach ($parametros as $key=>$val) {
            $this->_params[$key] = $val;
        }

        if (!file_exists($this->_path)) {
            $message = utf8_decode("Carpeta e vistas (view) no encontrada");
            die($message);
        }

        $this->setLayout();

    }

    /**
     * Función que renderiza la página.
     * @param array $view_callback
     * @param boolean $renderLayout
     */
    public function renderPHP($view_callback, $renderLayout)
    {
        $controller = strtolower($this->_params['controller']);
        $this->_params['view_callback'] = $view_callback;
        if ($renderLayout) {
            include_once APP_PATH_LAYOUT. '/' . $this->_layout;
        } else {
            $this->contenido();
        }

    }

    /**
     *
     */
    public function contenido()
    {
        $action = strtolower($this->_params['action']);

        extract($this->_params['view_callback']);

        ob_start();

        $path_view = $this->_path . "/$action.php";

        include $path_view;

        ob_end_flush();
    }

    /**
     * Función que gestiona algunos errores básicos
     * @param array $parametros
     * @throws Exception
     */
    protected function _gestionError(array $parametros = null)
    {
        if (is_null($parametros)) {
            $error = "FATAL ERROR: no hay parametros para crear la vista";
        } elseif (!is_array( $parametros)) {
            $error = "FATAL ERROR: no hay parametros para crear la vista";
        } if (!key_exists('controller', $parametros) && key_exists('action', $parametros)) {
            $error = "FATAL ERROR: no especificado Controller o Action";
        } else {
            $error = false;
        }

        if( $error ) {
            //TODO gestionar el error de manera pertinente.
            throw new Exception( $error );
            exit;
        }
    }

    /**
     * Función que establece con que Layout se va a trabajar
     * @param string $layoutName
     */
    public function setLayout($layoutName = null)
    {
        if (!$layoutName) {
            $layoutName = $this->_params['layout'];
        }

        if (!file_exists( APP_PATH_LAYOUT . '/' . $layoutName)) {
            $message = utf8_decode( "No se ha encontrado el layout por defecto." );
            die( $message);
        } else {
            $this->_layout = $layoutName;
        }
    }

    /**
     * Función para definir cuál será la vista asociada a la action por el usuario
     * @param string $viewName
     */
    public function setView($viewName = null)
    {
        if ($viewName) {
            if (!file_exists( $this->_path . "/$viewName.phtml")) {
                $this->_params['action'] = $viewName;
            } else {
                //todo gestion error
                die("Error vista no encontrada");
            }
        }
    }
}