<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		//return view('welcome_message');
		$session=session();
		if ($this->session->get('id')) $view='map.html';
		else $view='index.html';
		return $this->renderWithLayout($view, array('user'=>$session->get('user')));
	}

	//--------------------------------------------------------------------

}
