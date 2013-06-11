<?php
    echo $header;
?>
<div id="arena_div">
<script type="text/javascript" src="<?php echo base_url('assets/scripts/module/arena.js'); ?>"></script>
    <canvas id="canvas_rpg" width="640px" height="480px" style="margin-top: 10;"></canvas>
    <div id="hoptions">
        <div id="sound" class="sound-play"></div>
    </div>
    <input type="hidden" id="hcore" value="<?php echo base_url('assets/scripts/rpgJs/core/'); ?>" />
    <input type="hidden" id="avatar_file" value="<?php echo $user->avatar_filename; ?>" />

    <input type="hidden" id="site_url" value="<?php echo site_url(); ?>" />
</div>
<div id="battle" role="dialog" class="modal hide"></div>
<audio id="arenabgm" autoplay loop>
    <source src="<?php echo base_url('assets/Audio/BGM/arena.mp3'); ?>">
    <source src="<?php echo base_url('assets/Audio/BGM/arena.ogg'); ?>">
</audio>
<script type="text/javascript">
    $(function(){
        Arena.initView();
    });

</script>

    </body>
</html>


