<?php

class Template{

	private $data;

	function __construct(){


	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	

	public function load($url)
	{
		include($url);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function redirect($url)
	{
		header("Location: $url");
		exit;
	}




	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function set_data($name, $value, $clean=FALSE)
	{
		if ($clean == TRUE) {
			$this->data[$name] = $value;
		}
		else
			$this->data[$name] = $value;
	}


	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function get_data($name, $echo=TRUE)
	{
		if (isset($this->data[$name])) {
			if ($echo) {
				echo $this->data[$name];
			}
			else
				return $this->data[$name];
		}
		return '';
	}
}

?>