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
    public function mapstylegen() {
        $map=array();
        $dim=30;
        $zoom='';
        for ($i = 0; $i < $dim; $i++) {
            $map[$i]=array('with'=>$dim*50,'divx'=>array());
            for ($j = 0; $j < $dim; $j++) {
                $map[$i]['divx'][$j]=array('zoom'=>$zoom);
            }
        }
        return $this->renderWithLayout('genmap', array('divy'=>$map,'dim'=>$dim/*,'script'=>array('js/genmap.js')*/));
        
    }
}
