<div class="row">
    <div id="player" class="span3 pull-left">
        <h5><?php echo $player->name ?></h5>
        <div>
            <div class="progress" id="player_bar">
                <div class="bar bar-info" style="width: 100%;"></div>
            </div>
            <strong>HP: </strong>
            <span id="player_hp_div">
                <?php echo $p_current_hp; ?>
            </span>/ <?php echo $player->hp ?>
        </div>
        <div id="player_img" style="margin: 10px auto;">
            <div class="skill"></div>
            <div class="damage"></div>
            <img src="<?php echo site_url('assets/images/'.$player->avatar_filename) ?>" />
            <!--<img src="http://localhost/images.jpeg">-->
        </div>
    </div>

    <div class="span1 pull-left">
        <h3>VS</h3>
    </div>

    <div id="enemy" class="span3 pull-right">
        <h5><?php echo $enemy->name ?></h5>
        <div>
            <div class="progress" id="enemy_bar">
                <div class="bar bar-info" style="width: 100%;"></div>
            </div>
            <strong>HP: </strong>
            <span id="enemy_hp_div">
                <?php echo $e_current_hp; ?>
            </span>/ <?php echo $enemy->hp ?>
        </div>
        <div id="enemy_img" style="margin: 10px auto;">
            <div class="skill"></div>
            <div class="damage"></div>
            <img src="http://localhost/images.jpeg" wi>
            <!--<img src="<?php // echo site_url('assets/Graphics/Characters/'.$enemy->avatar) ?>" /> -->
        </div>
    </div>
</div>


<div class="row">
    <form action="<?php echo site_url('battle/fight') ?>" id="atk" method="post">
        <input type="hidden" name="player_hp" id="player_hp" placeholder="player hp" value="<?php echo $player->hp ?>" />

        <input type="hidden" name="enemy_id" id="enemy_id" value="<?php echo $enemy->id; ?>"  />
        <input type="hidden" name="enemy_hp" id="enemy_hp" placeholder="enemy hp"  value="<?php echo $enemy->hp ?>" />

        <div style="display: block; text-align: center;" id="button_placeholder">
            <input type="submit" id="attack" value="Attack!" class="btn btn-danger" />
            <input type="button" id="close" value="Back to Arena" style="display: none;" class="btn btn-inverse" />
        </div>
    </form>
</div>

