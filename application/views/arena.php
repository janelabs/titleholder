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


<div id="ap_modal" class="modal hide fade in">
    <div class="modal-header">
        <h3>Attribute Points</h3>
    </div>
    <form action="<?php echo site_url('battle/allocate'); ?>" id="ap_form" class="form-horizontal">
        <div class="modal-body">
            <div>You have five (<span id="attr_points">10</span>) AP left</div>
            <div class="control-group pull-left">
                <label class="control-label" for="atk">Attack</label>
                <div class="controls">
                    <input type="text" class="span1" name="atk" id="atk" value="0">
                    <button type="button" class="btn btn-inverse" id="atk-p">
                        <i class="icon-white icon-plus-sign"></i>
                    </button>
                    <button type="button" class="btn btn-inverse" id="atk-m" >
                        <i class="icon-white icon-minus-sign"></i>
                    </button>
                </div>
            </div>
            <div class="control-group pull-left">
                <label class="control-label" for="def">Defense</label>
                <div class="controls">
                    <input type="text" class="span1" name="def" id="def" value="0">
                    <button type="button" class="btn btn-inverse" id="def-p">
                        <i class="icon-white icon-plus-sign"></i>
                    </button>
                    <button type="button" class="btn btn-inverse" id="def-m">
                        <i class="icon-white icon-minus-sign"></i>
                    </button>
                </div>
            </div>
            <div class="control-group pull-left">
                <label class="control-label" for="hp">HP</label>
                <div class="controls">
                    <input type="text" class="span1" name="hp" id="hp" value="0">
                    <button type="button" class="btn btn-inverse" id="hp-p">
                        <i class="icon-white icon-plus-sign"></i>
                    </button>
                    <button type="button" class="btn btn-inverse" id="hp-m">
                        <i class="icon-white icon-minus-sign"></i>
                    </button>
                 </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            <button type="submit" class="btn btn-primary" id="allocate_ap">Assign</button>
        </div>
    </form>
</div>

<?php //for event generate
    for ($i = 0 ; $i < count($events) ; $i++) {
        ?>
        <input class="events" type="hidden" id="events_<?php echo $i; ?>" value="<?php echo $events[$i]; ?>" disabled="true" />
        <?php
    }
?>

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
        Arena.battleInitView();
    });
</script>

    </body>
</html>


