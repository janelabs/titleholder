<?php
    echo $header;
?>
<script type="text/javascript" src="<?php echo base_url('assets/scripts/module/arena.js'); ?>"></script>
<div id="div_main">
    <canvas id="canvas_rpg" width="640px" height="480px" style="margin-top: 10;"></canvas>
</div>
    <input type="hidden" id="hcore" value="<?php echo base_url('assets/scripts/rpgJs/core/'); ?>" />
    <input type="hidden" id="avatar_file" value="<?php echo $user->avatar_filename; ?>" />

    <input type="hidden" id="site_url" value="<?php echo site_url(); ?>" />
    </body>
</html>

<div id="battle" role="dialog" class="modal hide"></div>

<script type="text/javascript">
    $(function(){
        Arena.initView();
    });
</script>