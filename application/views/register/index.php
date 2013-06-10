
<div class="main_container"> <!-- start: main container -->

    <div class="inner_div"> <!-- start: inner div -->

<form action="<?php echo site_url('signup') ?>" method="post" id="signup">

    <h4>Player Information</h4>

    <div class="input_div">
        <label>Username</label>
        <input type="text" name="username" class="tbox" />
        <span id="username" class="vspan"></span>
    </div>
    <div class="input_div">
        <label>Password</label>
        <input type="password" name="password" class="tbox" />
        <span id="password" class="vspan"></span>
    </div>
    <div class="input_div">
        <label>Confirm Password</label>
        <input type="password" name="pwordconf" class="tbox" />
        <span id="pwordconf" class="vspan"></span>
    </div>
    <div class="input_div">
        <label>Email Address</label>
        <input type="text" name="email" class="tbox" />
        <span id="email" class="vspan"></span>
    </div>

    <div style="text-align: center;">

        <h4>Choose a Character</h4>
        <span id="avatar"></span>
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


        <h4>Choose a Pet</h4>
        <span id="pet"></span>
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

        <div>
            <input type="submit" value="Create Account" class="btn" />
            <span id="signup_message"></span>
        </div>
    </div>
</form>

        </div> <!-- end: inner div -->


</div> <!-- end: main container -->
