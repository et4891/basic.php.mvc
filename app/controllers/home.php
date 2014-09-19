<?php

class Home extends Controller
{
	// $this->params is passed here from App.php
	public function index($name = '')
	{
		// model method is from the parent class "Controller"
		$user = $this->model('User');
		$user->name = $name;
		
		// providing directory, has nothing to do with the url
		// user $data['name'] to call out the name
		$this->view('home/index', ['name' => $user->name]);
	}
}