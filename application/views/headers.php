<!DOCTYPE html>

<html>
<head>
    <title>TitleHolder</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/scripts/bootstrap/css/bootstrap.min.css'); ?>" />

    <script type="text/javascript" src="<?php echo base_url('assets/scripts/jquery.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/scripts/jscripts.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/scripts/rpgJs/rpg-beta-2.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/scripts/bootstrap/js/bootstrap.min.js'); ?>"></script>

    <script type="text/javascript">
        $(function(){
            $('#back_to_main').on("click", function(){
                $("#arena_frame").fadeOut("slow",function(){
                    $("#div_main").fadeIn("slow");
                });
            });
        });
    </script>

</head>

<body style="margin: 0; background-color: #fff;"> <!--  overflow: hidden; -->
<noscript>You must enable your javascript to view this game!</noscript><center>
<div id="arena_frame" style="display: none;">
    <iframe class="frame"></iframe>
    <button id="back_to_main">MENU</button>
</div>
