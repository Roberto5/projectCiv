<?php
namespace App\Controllers;

class Login extends BaseController
{
    public function index()
    {
        /**
         * test login
         */
        if ($this->session->get('user'))
            $this->response->redirect(base_url('Login'));
        $userModel = model('App\Models\UserModel');
        $form=$userModel->getLoginForm();
        if ($this->request->getMethod()=='post') {
            $where=array('user'=>$this->request->getGetPost('user'),'password'=>md5($this->request->getGetPost('password')));
            d($where);
            $user=$userModel->asObject()->where($where);//->first();
            d($userModel->validate($where));
        }
        
        return $this->renderWithLayout('login.html', array('form'=>$form));
    }
    
    public function logout()
    {
        //removing session
        $this->session->destroy();
        $this->response->redirect(base_url('Login'));
        //return 'ciao';
    }  
    //--------------------------------------------------------------------
    
}
