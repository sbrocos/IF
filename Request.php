<?php

class IF_REQUEST
{
	protected $request;

	public function __construct()
	{
		$query = parse_url( $_SERVER['REQUEST_URI'] );
		$this->request = explode('/', $query['path']);
	}

	public function getRequest()
	{

	}

	public function getParams()
	{

	}

	public function getParam ( $param )
	{

	}

	public function isPost( $param )
	{

	}

	public function isGet( $param )
	{

	}

	public function getPost()
	{

	}

	public function getGet()
	{

	}

}