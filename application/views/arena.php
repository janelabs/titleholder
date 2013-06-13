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


<div class="modal hide fade in" id="ap_modal">
    <div class="modal-header">
        <h3>Attribute Points</h3>
    </div>
    <form action="<?php echo site_url('battle/allocate'); ?>" id="ap_form">
    <div class="modal-body">
        <div>You have five (<span id="attr_points">0</span>) AP left</div>
        <div>
            <strong>Attack</strong>
            <input type="text" name="atk" value="0" class="input-small" id="atk" />
        </div>
        <div>
            <strong>Defense</strong>
            <input type="text" name="def" value="0" class="input-small" id="def" />
        </div>
        <div>
            <strong>HP</strong>
            <input type="text" name="hp" value="0" class="input-small" id="hp" />
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button type="submit" class="btn btn-primary" id="allocate_ap">Assign</button>
    </div>
    </form>
</div>


<div id="result">
<!--
for the battle result
was originally in the battle/index view
-->
</div>

<audio id="arenabgm" autoplay loop>
    <source src="<?php echo base_url('assets/Audio/BGM/arena.mp3'); ?>">
    <source src="<?php echo base_url('assets/Audio/BGM/arena.ogg'); ?>">
</audio>
<script type="text/javascript">
    $(function(){
        Arena.initView();
    });

    // allocate attribute points
    $('#ap_form').on('submit',function(e){

        // disable buttons while waiting for server response
        $('#ap_form .btn').addClass('disabled').attr('disabled','disabled');

        param = $(this).serialize();
        action = $(this).attr('action');

        $.post(action, param, function(data){
            $('#ap_form .btn').removeClass('disabled').removeAttr('disabled');
            alert(data.message);
        },'json');

        e.preventDefault();
    });

</script>

    </body>
</html>


