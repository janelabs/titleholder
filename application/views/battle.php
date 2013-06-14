<div id="player" style="display: block;">
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

<form action="<?php echo site_url('battle/fight') ?>" id="atk" method="post">
    <input type="hidden" name="player_hp" id="player_hp" placeholder="player hp" value="<?php echo $player->hp ?>" />

    <input type="hidden" name="enemy_id" id="enemy_id" value="<?php echo $enemy->id; ?>"  />
    <input type="hidden" name="enemy_hp" id="enemy_hp" placeholder="enemy hp"  value="<?php echo $enemy->hp ?>" />

    <div style="display: block; text-align: center;" id="button_placeholder">
        <input type="submit" id="attack" value="Attack!" />
        <input type="button" id="close" value="Back to Arena" style="display: none;" />
    </div>
</form>


    <div id="debugger"></div>

