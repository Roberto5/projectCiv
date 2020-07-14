<?php

namespace App\Controllers;

class Reg extends BaseController {
    public function index($username) {
        $user=model('App\Models\UserModel');
        $error='';
        if ($this->request->getMethod()=="post") {
            $data=$_POST;
            
            
            if ($user->validate($data)) {
                $data['pass_confirm']=$data['password']=password_hash($data['password'], PASSWORD_DEFAULT);
                
                $user->set($data);
                $user->insert($data);
                $this->response->redirect(base_url());
            }
            else {
                $errorV=$user->errors();
                foreach ($errorV as $e) 
                    $error.="<div>$e</div>";
            }
        }
        $form=$user->getRegForm('',$username);
        return $this->renderWithLayout('reg.html',array('form'=>$form,'error'=>$error));
    }
}