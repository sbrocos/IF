<?php
/**
 * 
 * @author Sergio
 *
 */

class IF_CONTROLLER
{
	private $_view;
	
	public function render()
	{
		$this->_view = new IF_VIEW($layout);
	}
	
	public function noLayout()
	{
		
	}
	
	public function noRender()
	{
		
	}
}