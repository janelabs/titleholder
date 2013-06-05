<?php
    echo $header;
?>
<script type="text/javascript" src="<?php echo base_url('assets/scripts/module/arena.js'); ?>"></script>

    <canvas id="canvas_rpg" width="640px" height="480px" style="margin-top: 10;"></canvas>

    <input type="hidden" id="hcore" value="<?php echo base_url('assets/scripts/rpgJs/core/'); ?>" />
    </body>
</html>

<script type="text/javascript">
    $(function(){
        Arena.initView();
    });
</script>