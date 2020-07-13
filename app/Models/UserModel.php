<?php
namespace App\Model;

use CodeIgniter\Model;
use phpDocumentor\Reflection\Types\This;

define('TABLE_USER', 'pc_users');

class UserModel extends Model {
    protected $table      = TABLE_USER;
    protected $primaryKey = 'id';
    
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    
    protected $allowedFields = ['name'/*, 'email'*/];
    
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    
    protected $validationRules    = [
        'user'     => 'required|alpha_numeric_space|min_length[3]|is_unique['.TABLE_USER.'.user]',
        //'email'        => 'required|valid_email|is_unique['.TABLE_USER.'.email]',
        'password'     => 'required|min_length[8]',
        'pass_confirm' => 'required_with[password]|matches[password]'
    ];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    function getLoginForm($action='') {
        helper('form');
        $form=form_open($action,array('class'=>'login'));
        $form.='<div>';
        $form.=form_input(array('name'=>'user'),'',['placeholder' => 'username']);
        $form.='</div><div>';
        $form.=form_password(array('name'=>'password'),'',['placeholder' => 'password']);
        $form.='</div>';
        $form.=form_submit('','Login');
        $form.=form_close();
        //d($form);
        return $form;
    }
}