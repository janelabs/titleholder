<div id="player" style="display: block">
    <h3><?php echo $player->name ?></h3>
    <div>
        <strong>HP: </strong>
        <span id="player_hp_div">
            <?php echo $p_current_hp; ?>
        </span>/ <?php echo $player->hp ?>
    </div>
</div>

<h2>VS</h2>

<div id="enemy" style="display: block">
    <h3><?php echo $enemy->name ?></h3>
    <div>
        <strong>HP: </strong>
        <span id="enemy_hp_div">
            <?php echo $e_current_hp; ?>
        </span>/ <?php echo $enemy->hp ?>
    </div>
</div>

<form action="<?php echo site_url('battle/view') ?>" id="atk" method="post">
    <input type="text" name="player_hp" id="player_hp" placeholder="player hp" value="<?php echo $player->hp ?>" />

    <input type="text" name="enemy_id" id="enemy_id" value="<?php echo $enemy->id; ?>"  />
    <input type="text" name="enemy_hp" id="enemy_hp" placeholder="enemy hp"  value="<?php echo $enemy->hp ?>" />

    <div style="display: block; text-align: center;">
        <input type="submit" id="attack" value="Attack!" />
    </div>
</form>

    <div id="result"></div>

<script type="text/javascript">
$('#atk').submit(function(e){
    // temporary disable attack button while waiting for server response
    $('#attack').attr('disabled','disabled');

    var action = $(this).attr('action');
    var param = $(this).serialize();

    $.post(action,param,function(response){
        $('#attack').removeAttr('disabled');

        if(response.status) {
            $('#result').html(JSON.stringify(response));

            $('#player_hp_div').html(response.player.hp);
            $('#enemy_hp_div').html(response.enemy.hp);

            $('#player_hp').val(response.player.hp);
            $('#enemy_hp').val(response.enemy.hp);

            if(response.player.is_dead) {
                $('#result').html('You were killed');
            }

            if(response.enemy.is_dead) {
                $('#result').html('You won the battle');
            }
        }
    },'json');

    e.preventDefault();
});
</script>

</body>
</html>