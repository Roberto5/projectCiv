<?php
namespace App\Controllers;

class Login extends BaseController
{
    public function index()
    {
        /**
         * test login
         */
        if ($this->session->get('id'))
            $this->response->redirect(base_url());
        $userModel = model('App\Models\UserModel');
        $form=$userModel->getLoginForm();
        $error='';
        if ($this->request->getMethod()=='post') {
            $where=array('user'=>$this->request->getGetPost('user'));//,'password'=>password_hash($this->request->getGetPost('password'),PASSWORD_DEFAULT));
            //d($where);
            $user=$userModel->where($where)->first();
            d($user);
            if (isset($user['id'])) {
                if (password_verify($this->request->getGetPost('password'), $user['password'])) {
                    $this->session->set($user);
                    $this->session->remove('password');
                    $this->response->redirect(base_url());
                }
                $error=lang('app.PASSERROR',array(base_url('login/recover')));
            }
            else {
                $error=lang('app.USERERROR',array($where['user'],base_url('reg/index/'.$where['user'])));
            }
        }
        
        return $this->renderWithLayout('login.html', array('form'=>$form,'error'=>$error));
    }
    
    public function logout()
    {
        //removing session
        $this->session->destroy();
        $this->response->redirect(base_url('Login'));
        //return 'ciao';
    }  
    public function recover() {
        return 'recupero';
    }
    //--------------------------------------------------------------------
    
}
