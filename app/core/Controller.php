<?php

class Controller
{
	public function model($model)
	{
		require_once '../app/models/' . $model . '.php';
		return new $model();
	}

	// $data will be available in / passed to this view
	public function view($view, $data = [])
	{
		require_once '../app/views/' . $view . '.php';
	}
}