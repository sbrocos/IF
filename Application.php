<?php
/**
 *
 * @author sbrocos
 * @version v.0.1
 */
class IF_APPLICATION
{

	protected $_data;
	protected $_layout;

	public function __construct()
	{
		$this->loaderIF();
		//
		$config = new IF_CONFIG();
		$appConfig = $config->getApplicationConf();
		$this->_layout = $appConfig->layout_default;
		
		unset($config);
		unset($appConfig);
		//
		$this->getUrl();
		//
//		$view = new IF_VIEW( $this->_data,  $appConfig->layout_default );

	}
	/**
	 * Funcion que carga la libreria IF.
	 * Solo archivos php, el resto los ignora.
	 */
	public function loaderIF()
	{
		$path = realpath( dirname(__FILE__) );

		//Accedemos a la ruta de la Liberia para leer los archivos de IF
		$dir_library = @opendir($path) or $this->errorApp(1);
		//Include de la libreria IF, solo archivos php, el resto los ignora
		while ( $file = readdir( $dir_library ) ) {
			if( strpos( $file, "php" ) ){
				include_once $path.'/'.$file;
			}
		}
		closedir( $dir_library );
	}

	/**
	 * functión que establece el errores relacionados con el Framework.
	 * @param integer $id
	 */
	protected function errorApp( $id )
	{
		switch ( $id ){
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

	protected function getUrl()
	{
		$default = "Index";

		$query = parse_url( $_SERVER['REQUEST_URI'] );

		$request = explode('/', $query['path']);

		if( count($request) > 2 ){
			$controller = strtolower( $request[1] );

			if( count($request) > 3 ){
				$action = strtolower( $request[2] );
			} else {
				$action = $default;
			}
		} else {
			$controller = $default;
			$action = $default;
		}
		$this->_data['controller'] = $controller;
		$this->_data['action'] = $action;

		$this->loadUrl( $controller, $action );
	}

	/**
	 *
	 * @param string $controller
	 * @param string $action
	 */
	protected function loadUrl( $controller, $action )
	{
		$controller .= "Controller";
		$action .= "Action";
		$pathController = APP_PATH . "/main/controllers/" . $controller .'.php';

		//verificar que existe el Controlador
		if( file_exists( $pathController ) ){
			//Cargar el controlador
			include_once $pathController;
			//Instanciamos la clase del Controlador
			$instance = new $controller;
			//ejecutamos (si es posible) la Action
// 			$callback = call_user_func( array($instance, "exec") );
		
			$instance->exec( $controller, $action, $this->_layout );
			
			
			
// 			if( !$callback ){
// 				$this->errorApp( 4 );
// 			}else{
// 				$this->_data['view_callback'] = $callback;
// 			}

		} else {
			$this->errorApp( 3 );
		}
	}
		
	public static function getDataUrl()
	{
// 		$default = "Index";
// 		$query = parse_url( $_SERVER['REQUEST_URI'] );
		
// 		if( count($request) > 2 ){
// 			$controller = strtolower( $request[1] );
		
// 			if( count($request) > 3 ){
// 				$action = strtolower( $request[2] );
// 			} else {
// 				$action = $default;
// 			}
// 		} else {
// 			$controller = $default;
// 			$action = $default;
// 		}
// 		$data['controller'] = $controller;
// 		$data['action'] = $action;
		
// 		return $data;
	}
}