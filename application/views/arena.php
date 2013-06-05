<!DOCTYPE html>

<html>
    <head>
        <title>TitleHolder</title>

        <script type="text/javascript" src="<?php echo base_url('assets/scripts/jquery.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/scripts/rpgJs/rpg-beta-2.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/scripts/module/arena.js'); ?>"></script>
    </head>

    <body style="margin: 0; overflow: hidden; background-color: #000;">
    <noscript>You must enable your javascript to view this game!</noscript>
    <canvas id="canvas_rpg" width="640px" height="480px" style="margin-top: 10;"></canvas>
    <input type="hidden" id="hcore" value="<?php echo base_url('assets/scripts/rpgJs/core/'); ?>" />
    </body>
</html>

<script type="text/javascript">
    $(function(){
        Arena.initView();
    });
</script>