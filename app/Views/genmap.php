<style>
    .tile {
        width: 50px;
    height: 50px;
    background: url(../img/tileset.png);
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


{divy}
<div style="with: {with}px;">
{divx}
<div class="tile {zoom} area-5"></div>
{/divx}
</div>
{/divy}