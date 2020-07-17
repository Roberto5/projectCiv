<?php 
use phpDocumentor\Reflection\Types\False_;

//merge 2 image whit arc


class tile {
    private $r=array();
    private $delta;
    private $rad;
    private $func='';
    private $dim;
    function __construct($option=null) {
        $default=array(
            'dim'=>50,
            'delta'=>15,
            'func'=>'Circle', // circle circleRandom linearX linearY
            'rad'=>25
        );
        //echo "costruisco...";
        if (is_array($option)) {
            foreach ($default as $key=>$value) {
                if (array_key_exists($key, $option)) $value=$option[$key];
                $this->$key=$value;
                //echo "$key -> $value";
            }
        }
        else {
            foreach ($default as $key => $value) {
                $this->$key=$value;
            }
        }
        /**/
        
    }
    function setFunc($func) {
        $this->func=$func;
        /*if (preg_match("/Random/", $this->func)) {
            $init='init'.$this->func;
            $this->$init();
        }*/
    }
    
    function initCircleRandom() {
        $this->r[0]=$this->rad;
        for ($i = 1; $i < 90; $i++) {
            $increment=rand(-1,1);
            $tempR=$this->r[$i-1]+$increment;
            if (($tempR>($this->rad+$this->delta))||($tempR<$this->rad-$this->delta)) $this->r[$i]=$this->r[$i-1];
            else $this->r[$i]=$tempR;
        }
        $this->r[90]=$this->rad;
        $i=90;
        $inc=0;// 25 -> 34 =2
        //echo "incremento ".abs($r[$i]-$r[$i-1]);
        while (($i>0)&&((abs($this->r[$i]-$this->r[$i-1]))>1)) {
            
            $inc=$this->r[$i]-$this->r[$i-1];//echo "incremento $inc";
            $this->r[$i-1]=$this->r[$i]-($inc/abs($inc));
            $i--;
        };
    }
    function initLinearXRandom() {
        $this->initLinearYRandom();
    }
    function initLinearYRandom() {
        $this->r[0]=$this->rad;
        for ($i = 1; $i < $this->dim; $i++) {
            $increment=rand(-1,1);
            $tempR=$this->r[$i-1]+$increment;
            if (($tempR>($this->rad+$this->delta))||($tempR<$this->rad-$this->delta)) $this->r[$i]=$this->r[$i-1];
            else $this->r[$i]=$tempR;
        }
        $this->r[$this->dim]=$this->rad;
        $i=$this->dim;
        $inc=0;// 25 -> 34 =2
        //echo "incremento ".abs($r[$i]-$r[$i-1]);
        while (($i>0)&&((abs($this->r[$i]-$this->r[$i-1]))>1)) {
            
            $inc=$this->r[$i]-$this->r[$i-1];//echo "incremento $inc";
            $this->r[$i-1]=$this->r[$i]-($inc/abs($inc));
            $i--;
        };
    }
    function Circle($x,$y) {
        return ($this->rad*$this->rad>($x*$x+$y*$y));
    }
    function CircleRandom($x,$y) {
        $a=round(rad2deg(atan2($y, $x)));
        return ($this->r[$a]*$this->r[$a]>($x*$x+$y*$y));
    }
    function LinearXRandom($x,$y) {
        return $y<$this->r[$x];
    }
    function LinearYRandom($x,$y) {
        return $x<$this->r[$y];
    }
    function mergeImg($d,$s) {
        preg_match("/Random/", $this->func,$find);
        if (count($find)>0) {
            $init='init'.$this->func;
            $this->$init();
        }
        $new= imagecreatetruecolor($this->dim, $this->dim);
        $func=$this->func;
        for ($i = 0; $i < $this->dim; $i++) {
            for ($j = 0; $j < $this->dim; $j++) {
                if ($this->$func($i,$j)) $m=$d; else $m=$s;
                //echo "$i : $j ".($this->$func($i,$j)? 'true' : 'false')."\n";
                if (!imagecopy($new, $m, $i, $j, $i, $j, 1, 1)) echo 'Errore!!!!';
            }
        }
        return $new;
    }
}


function combineTile($dest,$source) {
    $d=imagecreatefromjpeg($dest);
    $s=imagecreatefromjpeg($source);
    
    $dim=imagesx($d);
    $rad=$dim/2;
    $texture= imagecreatetruecolor($dim*3, $dim*3);
    $imghandle=new tile(array('func'=>'CircleRandom',
        'dim'=>$dim,
        'rad'=>$rad,
        'delta'=>10
    ));
    
    $new=$imghandle->mergeImg($d,$s);
    //angle
    imagecopy($texture, $new, $dim*2, $dim*2, 0, 0, $dim, $dim);
    imagedestroy($new);
    $new=$imghandle->mergeImg($d,$s);
    $rotate=imagerotate($new, 90, 0);
    imagecopy($texture, $rotate, $dim*2, 0, 0, 0, $dim, $dim);
    imagedestroy($new);
    imagedestroy($rotate);
    
    $new=$imghandle->mergeImg($d,$s);
    $rotate=imagerotate($new, 180, 0);
    imagecopy($texture, $rotate, 0, 0, 0, 0, $dim, $dim);
    imagedestroy($new);
    imagedestroy($rotate);
    
    $new=$imghandle->mergeImg($d,$s);
    $rotate=imagerotate($new, 270, 0);
    imagecopy($texture, $rotate, 0, $dim*2, 0, 0, $dim, $dim);
    imagedestroy($new);
    imagedestroy($rotate);
    // side
    //down
    $imghandle->setFunc('LinearXRandom');
    $new=$imghandle->mergeImg($d,$s);
    imagecopy($texture, $new, $dim, $dim*2, 0, 0, $dim, $dim);
    imagedestroy($new);
    //dx
    $new=$imghandle->mergeImg($d,$s);
    $rotate=imagerotate($new, 90, 0);
    imagecopy($texture, $rotate, $dim*2, $dim, 0, 0, $dim, $dim);
    imagedestroy($new);
    imagedestroy($rotate);
    //up
    $new=$imghandle->mergeImg($d,$s);
    $rotate=imagerotate($new, 180, 0);
    imagecopy($texture, $rotate, $dim, 0, 0, 0, $dim, $dim);
    imagedestroy($new);
    imagedestroy($rotate);
    //sx
    $new=$imghandle->mergeImg($d,$s);
    $rotate=imagerotate($new, 270, 0);
    imagecopy($texture, $rotate, 0, $dim, 0, 0, $dim, $dim);
    imagedestroy($new);
    imagedestroy($rotate);
    
    imagecopy($texture, $d, $dim, $dim, 0, 0, $dim, $dim);
    return $texture;
}

$images=array(
    'area-0.jpg',
    'area-1.jpg',
    'area-2.jpg',
    'area-3.jpg',
    'area-4.jpg',
    'area-5.jpg',
);
if ($_GET['debug']) {
    $sprite=combineTile($images[$_GET['d']],$images[$_GET['s']]);
}
else {
    $sprite= imagecreatetruecolor(900, 900);
    $x=0;
    /*$black = imagecolorallocate($sprite, 0, 0, 0);
    imagecolortransparent($sprite, $black);*/
    //imagealphablending($sprite, false);
    foreach ($images as $i) {
        $y=0;
        foreach ($images as $j) {
            if ($i!=$j) {
                $texture=combineTile($i,$j); 
                /*imagealphablending($texture, true);
                imagesavealpha($texture, true);
                
                imagealphablending($sprite, true);
                imagesavealpha($sprite, true);*/
                /*$black = imagecolorallocate($texture, 0, 0, 0);
                imagecolortransparent($texture, $black);*/
                imagecopy($sprite, $texture, $x, $y, 0, 0, 150, 150);
                imagedestroy($texture);
                
            }
            else {
                $img=imagecreatefromjpeg($i);
                imagecopy($sprite, $img, $x+50, $y+50, 0, 0, 50, 50);
                imagedestroy($img);
            }
            $y+=150;
        }
        $x+=150;
    }
}
/*

}*/



header("Content-type: image/png");

//$texture=combineTile($_GET['d'],$_GET['s']);

//print_r($imghandle);

imagepng($sprite);
imagedestroy($sprite);

?>