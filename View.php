<?php
/**
 *
 * @author sbrocos
 *
 */
class IF_VIEW
{
	protected $_path;
	protected $_layout;
	protected $_pathView;
	protected $_params;
	/**
	 *
	 * @param array $parametros
	 */
	public function __construct( array $parametros = null, $layout )
	{
		if( is_null( $parametros ) ) {
			$error = "FATAL ERROR: no hay parametros para crear la vista";
		} elseif ( !is_array( $parametros ) ) {
			$error = "FATAL ERROR: no hay parametros para crear la vista";
		} if( !key_exists( 'controller', $parametros ) && key_exists('action', $parametros) ) {
			$error = "FATAL ERROR: no especificado Controller o Action";
		} else {
			$error = false;
		}

		if( !$error ){
			$this->_params['contoller'] = $parametros['controller'];
			$this->_params['action'] = $parametros['action'];
			$this->_path = APP_PATH . '/main/views/' . $parametros['controller'];

			if( !file_exists( $this->_path ) ){
				$message = utf8_decode( "Carpeta e vistas (view) no encontrada" );
				die( $message);
			}

			if( !file_exists( APP_PATH_LAYOUT . '/' . $layout ) ){
				$message = utf8_decode( "No se ha encontrado el layout por defecto." );
				die( $message);
			} else {
				$this->_layout = $layout;
			}

			$this->renderPHP( $parametros );
		} else {
			//TODO gestionar el error de manera pertinente.
			throw new Exception( $error );
			exit;

		}
	}

	/***
	 *
	 * @param array $parametros
	 * @throws Exception
	 */
	public function renderPHP( array $parametros = null )
	{
		$controller = strtolower($parametros['controller']);

		include_once APP_PATH_LAYOUT. '/' . $this->_layout;

		include_once APP_PATH_LAYOUT. '/' . $this->_layout;

	}

	/**
	 *
	 */
	public function contenido()
	{
		$action = strtolower( $this->_params['action'] );
		ob_start();

		$path_view = $this->_path . "/$action.phtml";

		include $path_view;

		ob_end_flush();
	}
}