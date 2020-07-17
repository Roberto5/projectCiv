<style>
    .tile {
        width: 50px;
    height: 50px;
    background: url(tileset.png);
    display: inline-block;
    }
    .tile.zoom {
        width: 10px;
        height: 10px;
        background-size:180px 180px;
    }
    .area-0 {
        background-position: -50px -50px;
    }
    .area-0.zoom {
        background-position: -10px -10px;
    }
    .area-1 {
        background-position: -200px -200px;
    }
    .area-1.zoom {
        background-position: -40px -40px;
    }
    .area-2 {
        background-position: -350px -350px;
    }
    .area-2.zoom {
        background-position: -70px -70px;
    }
    .area-3 {
        background-position: -500px -500px;
    }
    .area-3.zoom {
        background-position: -100px -100px;
    }
    .area-4 {
        background-position: -650px -650px;
    }
    .area-4.zoom {
        background-position: -130px -130px;
    }
    .area-5 {
        background-position: -800px -800px;
    }
    .area-5.zoom {
        background-position: -160px -160px;
    }
</style>

<?php
$default=array(
    'dim'=>100,
    'p'=>array(
        30,
        5,
        3,
        3,
        3,
        50
    )
);

foreach ($default as $key => $value) {
    if (isset($_GET[$key])) $default[$key]=$_GET[$key];
}
$maxRand=0;
$R[0]=0;
foreach ($default['p'] as $value) {
    $maxRand+=$value;
    $R[]=$maxRand;
}

$map=[];
for ($i = 0; $i < $default['dim']; $i++) {
    for ($j = 0; $j < $default['dim']; $j++) {
        $r=rand(1,$maxRand);
        for ($k = 0; $k < count($default['p']); $k++) {
            if (($r>$R[$k])&&($r<=$R[$k+1])) $map[$i][$j]=$k;
        }
        
    }
}

foreach ($map as $value) {
    echo "<div style='width: ".($default['dim']*50)."px;'>";
    foreach ($value as $v) {
        echo "<div class='tile area-$v  zoom'></div>";
    };
    echo '</div>';
}