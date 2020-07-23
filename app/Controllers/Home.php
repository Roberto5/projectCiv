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
        $this->response->setContentType("text/css");
        $nArea=6;
        $dimTile=50;
        $dimTileset=900;
        $zoom=array(5,2,1);
        $css='.tile {
        width: 50px;
    height: 50px;
    background: url(../img/tileset.png);
    display: inline-block;
    }
    .map {
        height: 50px;
    }';/*
    .zoom {
        height: 10px;
    }
    .zoom2 {
        height: 25px;
    }
    .tile.zoom {
        width: 10px;
        height: 10px;
        background-size:180px 180px;
    }';*/
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
    public function mapgen() {
        $map=array();
        $dim=30;
        $zoom=1;
        for ($i = 0; $i < $dim; $i++) {
            $map[$i]=array('with'=>$dim*50,'divx'=>array());
            for ($j = 0; $j < $dim; $j++) {
                $map[$i]['divx'][$j]=array('zoom'=>$zoom);
            }
        }
        return $this->renderWithLayout('genmap', array('zoom'=>$zoom,'divy'=>$map,'dim'=>$dim,'style'=>array('mapstylegen')/*,'script'=>array('js/genmap.js')*/));
    }
}
