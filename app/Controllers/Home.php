<?php namespace App\Controllers;

class Home extends BaseController
{
    private $zoom=array(5,2,1,0.5);
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
        $this->response->setContentType("text/css");
        $nArea=6;
        $dimTile=50;
        $dimTileset=900;
        $zoom=$this->zoom;
        $css='.tile {
        width: 50px;
    height: 50px;
    background: url('.base_url().'/img/tileset.png);
    display: inline-block;
    }
    .map {
        height: 50px;
    }';
        foreach ($zoom as $key => $value) {
            if ($value!=1) {
                $dim=($dimTile/$value).'px';
                $dimT=($dimTileset/$value).'px';
                $css.=".zoom$key {height: $dim}";
                $css.=".tile.zoom$key {width: $dim;height: $dim;background-size: $dimT;}";
            }
            
        }
        for ($i = 0; $i < $nArea; $i++) {
            // main area tile
            $x=(50+$i*150);
            $y=(50+$i*150);
            $xt=$x.'px';
            $yt=$y.'px';
            $css.=".area-$i {background-position: -$xt -$yt;}";
            foreach ($zoom as $key => $value) {
                if ($value!=1) {
                    $xz=($x/$value).'px';
                    $yz=($y/$value).'px';
                    $css.=".area-$i.zoom$key {background-position: -$xz -$yz;}";
                }
                
            }
           
        }
        echo $css;
        
    }
    public function mapgen($zoom=1) {
        $map=array();
        $dim=30;
        if (($zoom<0)||($zoom>count($this->zoom))) {
            $zoom=0;
        }
        for ($i = 0; $i < $dim; $i++) {
            $map[$i]=array('with'=>$dim*50/$this->zoom[$zoom],'divx'=>array());
            for ($j = 0; $j < $dim; $j++) {
                $map[$i]['divx'][$j]=array('zoom'=>$zoom);
            }
        }
        return $this->renderWithLayout('genmap', array('zoom'=>$zoom,'divy'=>$map,'dim'=>$dim,'style'=>array('home/mapstylegen'),'script'=>array('js/genmap.js')));
    }
}
