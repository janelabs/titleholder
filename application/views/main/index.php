<?php
 echo $header;
?>

<div id="div_main">
    <!-- avatar -->
    <div class="div_child">
        <?php
            $left = '0px';
            if ($user['avatar_image'] == 'c_01.png') {
                $left = '-2px';
            }
            if ($user['avatar_image'] == 'c_04.png') {
                $left = '-55px';
            }
        ?>
        <img style="left: <?php echo $left; ?> !important;" id="user_dp" src="<?php echo base_url('assets/images/char-main/'.$user['avatar_image']); ?>" />
    </div>

    <!-- pet -->
    <div class="div_child">
        <img id="user_pet" src="<?php echo base_url('assets/pets/'.$user['pet_image']); ?>" />
    </div>

    <!-- stats -->
    <div class="div_child user_stat">
        <table border="0px" class="status" cellpadding="3" cellspacing="3">
            <tr>
                <td>HP: </td>
                <td class="td_elem"><?php echo $user['user_hp']; ?></td>
            </tr>
            <tr><td></td></tr>
            <tr>
                <td>Level: </td>
                <td class="td_elem"><?php echo $user['user_lvl']; ?></td>
            </tr>
            <tr><td></td></tr>
            <tr>
                <td>Experience: </td>
                <td class="td_elem"><?php echo $user['user_xp']; ?></td>
            </tr>
            <tr><td></td></tr>
            <tr>
                <td>Attack: </td>
                <td class="td_elem"><?php echo $user['user_atk']; ?></td>
            </tr>
            <tr><td></td></tr>
            <tr>
                <td>Defense: </td>
                <td class="td_elem"><?php echo $user['user_def']; ?></td>
            </tr>
        </table>
    </div>

    <!-- menu -->
    <div class="div_child">
        <button id="btn_rank">RANKS</button>
        <button id="btn_log">LOGS</button>
    </div>

    <!-- arena -->
    <div class="div_child">
        <button id="btn_arena">ARENA</button>
    </div>

    <div class="div_child">
        <button id="sound" class="music_toggle"><i id="soundicon" class="icon-volume-up"></i></button>
    </div>

    <div class="div_child">
        <button id="btn_logout" class="logout"><i class="icon-off"></i></button>
    </div>
</div>
</center>
<audio id="arenabgm" autoplay loop>
    <source src="<?php echo base_url('assets/Audio/BGM/char-main.mp3'); ?>">
    <source src="<?php echo base_url('assets/Audio/BGM/char-main.ogg'); ?>">
</audio>

<div class="modal hide fade" role="dialog" id="logout" style="display: none;">
    <div class="modal-body">
        <span>Sure to logout?</span>
    </div>

    <div class="modal-footer">
        <a class="btn btn-info" data-dismiss="modal">NO</a>
        <a class="btn btn-danger" href="<?php echo site_url('logout'); ?>">YES</a>
    </div>
</div>
</body>
</html>

<script type="text/javascript">
    $(function(){
        var soundToggle = getCookie();

        $('#btn_arena').on("click", function(){
            $("#div_main").fadeOut("slow",function(){
                $("#arena_frame").fadeIn("slow");
            });

            $('#arena_frame iframe').attr({src : "<?php echo site_url('arena'); ?>"});

            if (soundToggle == 1) {
                changeBGM('arena');
            }
        });

        $('#btn_log').on("click", function(){
            $("#div_main").fadeOut("slow",function(){
                $("#logs_frame").fadeIn("slow");
            });

            $('#logs_frame iframe').attr({src : "<?php echo site_url('logs'); ?>"});

            if (soundToggle == 1) {
                changeBGM('menus');
            }
        });

        $('#btn_rank').on("click", function(){
            $("#div_main").fadeOut("slow",function(){
                $("#rank_frame").fadeIn("slow");
            });

            $('#rank_frame iframe').attr({src : "<?php echo site_url('ranking'); ?>"});

            if (soundToggle == 1) {
                changeBGM('menus');
            }
        });

        $('#btn_logout').on("click", function(){
            $('#logout').modal();
        });

    });
</script>