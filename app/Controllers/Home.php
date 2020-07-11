<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		//return view('welcome_message');
		return $this->renderWithLayout('prova', array('script'=>array('home.js'),'style'=>array('style.css','theme.css')));
	}

	//--------------------------------------------------------------------

}
