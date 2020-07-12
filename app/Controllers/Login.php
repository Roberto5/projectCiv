<?php
namespace App\Controllers;

class Login extends BaseController
{
    public function index()
    {
        /**
         * test login
         */
        $session = session();
        $session->set("user",'test');
        //return $this->renderWithLayout('prova', array());
    }
    
    //--------------------------------------------------------------------
    
}
