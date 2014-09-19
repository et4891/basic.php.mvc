<?php

class App
{
	/* Default Controller */
	protected $controller = 'home';
	/* Default Method */
	protected $method 		= 'index';
	/* Default Parameters */
	protected	$params 		= [];

	public function __construct()
	{
		$url = $this->parseUrl();

		// Check controller existance if not, default controller runs
		if (file_exists('../app/controllers/' . $url[0] . '.php'))
		{
			$this->controller = $url[0];
			unset($url[0]);
		}

		require_once '../app/controllers/' . $this->controller . '.php';

		// Creates new object
		$this->controller = new $this->controller;

		// Check method existance if not, default method runs
		if (isset($url[1]))
		{
			if (method_exists($this->controller, $url[1]))
			{
				$this->method = $url[1];
				unset($url[1]);
			}
		}

		// this will reset the key for the array
		// also reason why we are unsetting the controller and method above
		$this->params = $url ? array_values($url) : [];

		call_user_func_array([$this->controller, $this->method], $this->params);		
	}

	/*Parsing URLS*/
	// Explode, trimming, sanitize urls
	// Giving different path to url - controller, method, parameters
	public function parseUrl()
	{
		if (isset($_GET['url']))
		{
			// returns the url into arrays
			return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
		}
	}
}