<form action="<?php echo site_url('signup') ?>" method="post" id="signup">
    <input type="hidden" name="avatar" value="3" />
    <input type="hidden" name="pet" value="2" />

    <div>
        <input type="text" name="username" placeholder="Username" />
        <span id="username" class="vspan"></span>
    </div>
    <div>
        <input type="password" name="password" placeholder="Password" />
        <span id="password" class="vspan"></span>
    </div>
    <div>
        <input type="password" name="pwordconf" placeholder="Confirm Password" />
        <span id="pwordconf" class="vspan"></span>
    </div>
    <div>
        <input type="text" name="email" placeholder="Email Address" />
        <span id="email" class="vspan"></span>
    </div>
    <div>
        <span id="avatar"></span>
        <h4>Choose a Character</h4>
    <?php if($avatars): ?>
        <?php foreach($avatars as $avatar): ?>
        <div>
            <img src="<?php echo "http://localhost/images.jpeg" //$avatar->avatar_filename ?>" id="<?php echo $avatar->avatar_id ?>" />
            ATK: <?php echo $avatar->avatar_attack ?>
            DEF: <?php echo $avatar->avatar_defense ?>
            HP: <?php echo $avatar->avatar_hp ?>
            EXP: <?php echo $avatar->avatar_exp ?>
            <div><?php echo $avatar->avatar_description ?></div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
    </div>
    <div>
        <span id="pet"></span>
        <h4>Choose a Pet</h4>
        <?php if($pets): ?>
            <?php foreach($pets as $pet): ?>
                <div>
                    <img src="<?php echo "http://localhost/images.jpeg" //$pet->pet_image ?>" id="<?php echo $pet->pet_id ?>" />
                    ATK: <?php echo $pet->pet_attack ?>
                    DEF: <?php echo $pet->pet_defense ?>
                    HP: <?php echo $pet->pet_hp ?>
                    EXP: <?php echo $pet->pet_xp ?>
                    <div><?php echo $pet->pet_description ?></div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
    </div>
    <div>
        <input type="submit" value="Create Account" />
        <span id="signup_message"></span>
    </div>
</form>
