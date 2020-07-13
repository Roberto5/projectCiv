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
        
        
        return $this->renderWithLayout('login.html', array());
    }
    
    //--------------------------------------------------------------------
    
}
