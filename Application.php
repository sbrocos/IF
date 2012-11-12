<?php
namespace ICHI;

/**
* Short description for class
*
* Long description for class (if any)...
*
* @category   IF
* @package    IF_APPLICATION
* @copyright  Copyright (c) 2012 Sergio Brocos (http://ichiframework.es)
* @license    http://ichiframework.es/license   BSD License
* @author     sbrocos
* @version    V.0.1
* @since      Class available since Release V.0.1
*/
class IF_APPLICATION
{
    /**
     * Función del constructor de la clase
     */
    function __construct ()
    {
        //Carga las librerias de IF
        $this->loaderIF();
        //Carga la configuración General
        $config = new IF_CONFIG();
        $appConfig = $config->getApplicationConf();
        $this->_data['layout'] = $appConfig->layout_default;
        //Eliminamos variables que no necesitamos
        unset ($config);
        unset ($appConfig);
        //
        $this->getUrl();
        //Creamos obj view
        $this->_view = new IF_VIEW($this->_data);

        $this->loadUrl();
    }

    /**
     * Funcion que carga la libreria IF.
     * Sólo carga los archivos php, el resto los ignora.
     * Posiblemente habra que habrá que cambiarlo por algo más concreto.
     */
    public function loaderIF()
    {
        $path = realpath(dirname(__FILE__));

        //Accedemos a la ruta de la Liberia para leer los archivos de IF
        $dir_library = @opendir($path) or $this->errorApp(1);
        //Include de la libreria IF, solo archivos php, el resto los ignora
        while ($file = readdir($dir_library)) {
            if (strpos( $file, "php")) {
                include_once $path.'/'.$file;
            }
        }
        closedir($dir_library);
    }

    /**
     * functión que establece el errores relacionados con el Framework.
     * Habrá que replantearlo otra vez, porque ahora mismo es un poco inútil.
     * @param integer $id
     */
    protected function errorApp( $id )
    {
        switch ($id) {
            case 1:
                $mensaje = "No se ha podido leer la libreria de <b>IF<br/>";
                break;
            case 2:
                $mensaje = "Controlador <b>NO ENCONTRADO</b>.";
                break;
            case 3:
                $mensaje = "Fichero del Controlador <b>NO ENCONTRADO</b>.";
                break;
            case 3:
                $mensaje = "<b>NO SE HA ENCONTRADO</b> el Action solicitado.";
                break;
            default:
                $mensaje = "Ichi Framework, esta totalmente roto<br/>";
        }

        echo "<h2>ERROR FATAL:</h2>";
        echo "<br/>";
        echo $mensaje;
        exit();
    }

    /**
     * Función que carga la info del SERVER['REQUEST_URI'] para determinar controller/action.
     * Si no establece por defecto INDEX en ambos casos
     */
    protected function getUrl()
    {
        $default = "Index";

        $query = parse_url($_SERVER['REQUEST_URI']);

        $request = explode('/', $query['path']);

        if ( count($request) > 2 ) {
            $controller = strtolower($request[1]);

            if ( count($request) >= 3 ) {
                $action = strtolower($request[2]);
            } else {
                $action = $default;
            }
        } else {
            $controller = $default;
            $action = $default;
        }
        $this->_data['controller'] = ucfirst($controller);
        $this->_data['action'] = ucfirst($action);

    }

    /**
     * Función que carga la action para luego ejecutar la vista
     * @param string $controller
     * @param string $action
     */
    protected function loadUrl()
    {
        $this->_data['controller'] .= "Controller";
        $this->_data['action'] .= "Action";

        $pathController = APP_PATH . "/main/controllers/" . $this->_data['controller'] .'.php';

        //verificar que existe el Controlador
        if (file_exists($pathController)) {
            //Cargar el controlador
            include_once $pathController;
            //Instanciamos la clase del Controlador
            $instance = new $this->_data['controller'];
            $action = $this->_data['action'];

            //llamamos a la función que ejecuta la action pertinente.
            $instance->exec($this->_view, $this->_data['action']);

        } else {
            $this->errorApp(3);
        }
    }
}

?>