<!DOCTYPE html>

<html>
<head>
    <title>TitleHolder</title>
    <meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/scripts/bootstrap/css/bootstrap.min.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>" />


    <script type="text/javascript" src="<?php echo base_url('assets/scripts/jquery.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/scripts/jquery.spritely-0.6.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/scripts/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/scripts/jscripts.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/scripts/rpgJs/rpg-beta-2.js'); ?>"></script>

    <script type="text/javascript">
        $(function(){

            $('.back_to_main').css({'z-index': 0});
            $('.back_to_main').on("click", function(){
                var parent_div = $(this).parent('div').attr('id');
                $('#' + parent_div).fadeOut("slow",function(){
                    window.location = "<?php echo site_url(); ?>";
                });
            });

            var soundToggle = getCookie();
            if (soundToggle == 1) {
                $('button, input[type="submit"], input[type="button"], .btn').on('mouseenter', function(){
                    if (soundToggle == 1) {
                        $('#btn_sfx_hover')[0].play();
                    }
                }).click(function(){
                        if (soundToggle == 1) {
                        $('#btn_sfx_click')[0].play();
                        }
                });
            }
        });

    </script>
</head>

<body style="margin: 0; background-color: #fff;"> <!--  overflow: hidden; -->
<noscript>You must enable your javascript to view this game!</noscript><center>

<audio id="btn_sfx_hover">
    <source src="<?php echo base_url('assets/SFX/btn-hover.mp3'); ?>">
    <source src="<?php echo base_url('assets/SFX/btn-hover.ogg'); ?>">
</audio>
<audio id="btn_sfx_click">
    <source src="<?php echo base_url('assets/SFX/btn-click.mp3'); ?>">
    <source src="<?php echo base_url('assets/SFX/btn-click.ogg'); ?>">
</audio>

<div id="arena_frame" style="display: none;">
    <iframe class="frame"></iframe>
    <button class="back_to_main minibtn">MENU</button>
</div>
<div id="logs_frame" style="display: none;">
    <iframe class="frame"></iframe>
    <button class="back_to_main minibtn">MENU</button>
</div>
<div id="rank_frame" style="display: none;">
    <iframe class="frame"></iframe>
    <button class="back_to_main minibtn">MENU</button>
</div>
