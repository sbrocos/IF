<?php
/**
 * 
 * @author Sergio
 *
 */

class IF_CONTROLLER
{
	private $_view;
	private $data_app;
	
	
	public function view( $data )
	{
		$param = IF_APPLICATION::getDataUrl();
	}
	public function exec( $controller, $action, $instance )
	{
		$this->data_app = call_user_func( array($instance, $action) );
		
		$this->_view = new IF_VIEW2( $this->_data,  $appConfig->layout_default );
		IF_DEBUG::dump($this->data_app);
		die();
	}
	
	public function noLayout()
	{
		
	}
	
	public function noRender()
	{
		
	}
}