<?php
    echo $header;
?>
<div id="arena_div">
<script type="text/javascript" src="<?php echo base_url('assets/scripts/module/arena.js'); ?>"></script>
    <canvas id="canvas_rpg" width="640px" height="480px" style="margin-top: 10;"></canvas>

    <input type="hidden" id="hcore" value="<?php echo base_url('assets/scripts/rpgJs/core/'); ?>" />
    <input type="hidden" id="avatar_file" value="<?php echo $user->avatar_filename; ?>" />
    <input type="hidden" id="userid" value="<?php echo $user->id; ?>" />

    <input type="hidden" id="site_url" value="<?php echo site_url(); ?>" />
</div>
<div id="battle" role="dialog" class="modal hide" style="position: absolute; top: 100px; left: 280px; width: 638px; height: 290px; background: url('<?php echo base_url('assets/images/battle.jpg'); ?>');"></div>


<div id="ap_modal" class="modal hide fade in" data-backdrop="static">
    <div class="modal-header">
        <h3>Attribute Points</h3>
    </div>
    <form action="<?php echo site_url('battle/allocate'); ?>" id="ap_form" class="form-horizontal">
        <div class="modal-body">
            <input type="hidden" id="ap_hide" />
            <div>You have five (<span id="attr_points">0</span>) AP left</div>

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
            <div class="control-group pull-left">
                <label class="control-label" for="attk">Attack</label>
                <div class="controls">
                    <input type="text" class="span1" name="attk"  id="attk" value="0">
                    <button type="button" class="btn btn-inverse" id="attk-p">
                        <i class="icon-white icon-plus-sign"></i>
                    </button>
                    <button type="button" class="btn btn-inverse" id="attk-m">
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

<div id="userstat" class="u_stats">
    HP: <span id="u_hp">-</span>
    ATTACK: <span id="u_atk">-</span>
    DEFENSE: <span id="u_def">-</span>
    LEVEL: <span id="u_lvl">-</span>
    XP: <span id="u_exp">-</span>
</div>


<?php //for event generate
if ($events):
    for ($i = 0 ; $i < count($events) ; $i++) {
        ?>
        <input class="events" type="hidden" id="events_<?php echo $i; ?>" value="<?php echo $events[$i]; ?>" disabled="true" />
    <?php
    }
else:
    ?>
    <input class="events" type="hidden" id="events_0" value="0" disabled="true" />
<?php
endif;
?>

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


