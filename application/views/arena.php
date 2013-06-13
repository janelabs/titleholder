<?php
    echo $header;
?>
<div id="arena_div" xmlns="http://www.w3.org/1999/html">
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

class="modal hide fade in"
<div id="ap_modal">
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

    // if input is not numeric, change to 0
    $('#atk, #def, #hp').on('keyup',function(){
        var input = $(this).val();
        var is_numeric = $.isNumeric(input);
        if (!is_numeric) {
            $(this).val(0);
        }
    });

    // plus-minus function for those who don't like to use the keyboard
    $('#atk-p, #def-p, #hp-p, #atk-m, #def-m, #hp-m').on('click',function(event){

        var value = 0;
        var btns = event.target.id;
        var btn = btns.split('-');
        var total_ap = parseInt($('#attr_points').text());
        var txt_val = $('#'+btn[0]).val();

        // if method is plus
        if (btn[1] == 'p') {
            if(total_ap) {
                value = parseInt(txt_val) + 1;
                total_ap = total_ap - 1;

                $('#'+btn[0]).val(value);
            }
        }

        // if method is minus
        if (btn[1] == 'm') {
            if(txt_val > 0) {
                value = parseInt(txt_val) - 1;
                total_ap = total_ap + 1;
            }

            $('#'+btn[0]).val(value);
        }

        $('#attr_points').text(total_ap);

    });

</script>

    </body>
</html>


