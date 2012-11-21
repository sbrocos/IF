<?php
namespace ICHI;

/**
* Clase que trata la configuración
*
* Clase que carga desde el fichero /app/config/config.local.json para poder cargar las configuraciones
* de la web que deben ser rellenados por el usuario.
*
* @category   IF
* @package    IF_CONFIG
* @copyright  Copyright (c) 2012 Sergio Brocos (http://ichiframework.es)
* @license    http://ichiframework.es/license   BSD License
* @author     sbrocos
* @version    V.0.1
* @since      Class available since Release V.0.1
*/

class IF_CONFIG
{
    /**
     * Contiene el Obj del json de 'config.local.json'
     * @var stdClass
     */
    protected $_json;

    /**
     * Función del constructor de la clase.
     */
    public function __construct()
    {
        if (file_exists( APP_PATH.'/config')) {
            $file = file_get_contents( APP_PATH.'/config'."/config.local.json" );
            $this->_json = json_decode( $file );
        } else {
            //TODO show error
            $message = utf8_decode('Error: fichero de configuración no encontrado');
            die( $message );
        }
    }

    /**
     * Funcion que recoge los datos de la base de datos del fichero  'config.local.json'
     * De momento solo recoge de una posible conexión a bbdd.
     * No verifica si los campos están vacios o no.
     *
     * @return array
     */
    public function getDatabaseConf()
    {
        if (isset($this->_json->database_configure)) {
            $count = count( $this->_json->database_configure[0] );
            if ($count == 1) {
                $database = $this->_json->database_configure[0];
            }else{
                //TODO por hacer
            }

            unset( $var );
            return $database;
        } else {
            //TODO show error
            $message = utf8_decode( 'ERROR: datos relacionados con la base de datos no están configurados.' );
            die( $message);
        }

    }

    /**
     * Funcion que carga los datos de configuración de la seccion "application_configure", o configuracion basica
     * de la aplicacion.
     *
     * @return array
     */
    public function getApplicationConf()
    {
        if (isset($this->_json->application_configure)) {
            return $this->_json->application_configure[0];
        } else {
            //TODO show error
            $message = utf8_decode('ERROR: datos relacionados con la configuración de la aplicación no están.');
            die($message);
        }
    }
}
