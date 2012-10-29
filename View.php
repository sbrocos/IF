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
		$this->_gestionError( $parametros );

		$this->_path = APP_PATH . '/main/views/' . $parametros['controller'];

		$this->_gestionParams( $parametros );


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

		$this->renderPHP();
	}

	/***
	 *
	 * @param array $parametros
	 * @throws Exception
	 */
	public function renderPHP()
	{
		$controller = strtolower($this->_params['controller']);

		include_once APP_PATH_LAYOUT. '/' . $this->_layout;


	}

	/**
	 *
	 */
	public function contenido()
	{
		$action = strtolower( $this->_params['action'] );

		extract( $this->_params['view_callback'] );

		ob_start();

		$path_view = $this->_path . "/$action.phtml";

		include $path_view;

		ob_end_flush();
	}

	protected function _gestionParams( array $parametros )
	{
		foreach ( $parametros as $key=>$val ) {
			$this->_params[$key] = $val;
		}

	}

	protected function _gestionError( array $parametros = null )
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

		if( $error ) {
			//TODO gestionar el error de manera pertinente.
			throw new Exception( $error );
			exit;
		}
	}
}