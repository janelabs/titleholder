<form action="<?php echo site_url('signup') ?>" method="post" id="signup">

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

            <ul class="options">
                <li>
                    <input type="radio" name="avatar" id="av<?php echo $avatar->avatar_id ?>" value="<?php echo $avatar->avatar_id ?>" />
                    <label for="av<?php echo $avatar->avatar_id ?>">
                        <img src="http://127.0.0.1/images.jpeg"  alt="<?php echo $avatar->avatar_filename ?>" />
                    </label>
                </li>
            </ul>

            <div class="desc" id="avatar_<?php echo $avatar->avatar_id ?>">
                ATK: <?php echo $avatar->avatar_attack ?>
                DEF: <?php echo $avatar->avatar_defense ?>
                HP: <?php echo $avatar->avatar_hp ?>
                EXP: <?php echo $avatar->avatar_exp ?>
                <?php echo $avatar->avatar_description ?>
            </div>

            <?php endforeach; ?>
        <?php endif; ?>

    </div>

    <div>
        <span id="pet"></span>
        <h4>Choose a Pet</h4>
        <?php if($pets): ?>

            <?php foreach($pets as $pet): ?>

            <ul class="options">
                <li>
                    <input type="radio" name="pet" id="pet<?php echo $pet->pet_id ?>" value="<?php echo $pet->pet_id ?>" />
                    <label for="pet<?php echo $pet->pet_id ?>">
                        <img src="http://127.0.0.1/images.jpeg"  alt="<?php echo $pet->pet_image ?>" />
                    </label>
                </li>
            </ul>

            <div class="desc" id="pet_<?php echo $pet->pet_id ?>">
                ATK: <?php echo $pet->pet_attack ?>
                DEF: <?php echo $pet->pet_defense ?>
                HP: <?php echo $pet->pet_hp ?>
                EXP: <?php echo $pet->pet_xp ?>
                <?php echo $pet->pet_description ?>
            </div>

            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div>
        <input type="submit" value="Create Account" />
        <span id="signup_message"></span>
    </div>
</form>
