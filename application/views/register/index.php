
<div class="main_container"> <!-- start: main container -->

    <div class="inner_div"> <!-- start: inner div -->

<form action="<?php echo site_url('signup') ?>" method="post" id="signup">

    <h4>Player Information</h4>

    <div class="input_div">
        <label>Username</label>
        <input type="text" name="username" class="tbox" id="username" />
        <span class="vspan"></span>
    </div>
    <div class="input_div">
        <label>Password</label>
        <input type="password" name="password" class="tbox" id="password" />
        <span class="vspan"></span>
    </div>
    <div class="input_div">
        <label>Confirm Password</label>
        <input type="password" name="pwordconf" class="tbox" id="pwordconf" />
        <span class="vspan"></span>
    </div>
    <div class="input_div">
        <label>Email Address</label>
        <input type="text" name="email" class="tbox" id="email" />
        <span class="vspan"></span>
    </div>

    <div style="text-align: center;">

        <h4>Choose a Character</h4>
        <?php if($avatars): ?>
        <ul class="options" id="avatar">
            <?php foreach($avatars as $avatar): ?>
                <li>
                    <input type="radio" name="avatar" id="av<?php echo $avatar->avatar_id ?>" value="<?php echo $avatar->avatar_id ?>" />
                    <label for="av<?php echo $avatar->avatar_id ?>">
                        <img src="<?php echo base_url('assets/images').'/'.$avatar->avatar_filename?>"  alt="<?php echo $avatar->avatar_filename ?>" />
                    </label>
                    <div class="desc" id="avatar_<?php echo $avatar->avatar_id ?>">
                        <span><strong>ATK:</strong> <?php echo $avatar->avatar_attack ?></span>
                        <span><strong>DEF:</strong> <?php echo $avatar->avatar_defense ?></span>
                        <span><strong>HP:</strong> <?php echo $avatar->avatar_hp ?></span>
                        <span><strong>EXP:</strong> <?php echo $avatar->avatar_exp ?></span>
                        <span><?php echo $avatar->avatar_description ?></span>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>


        <h4>Choose a Pet</h4>
        <?php if($pets): ?>
        <ul class="options" id="pet">
            <?php foreach($pets as $pet): ?>
                <li>
                    <input type="radio" name="pet" id="pet<?php echo $pet->pet_id ?>" value="<?php echo $pet->pet_id ?>" />
                    <label for="pet<?php echo $pet->pet_id ?>">
                        <img src="http://127.0.0.1/images.jpeg"  alt="<?php echo $pet->pet_image ?>" />
                    </label>
                    <div class="desc" id="pet_<?php echo $pet->pet_id ?>">
                        <span><strong>ATK:</strong> <?php echo $pet->pet_attack ?></span>
                        <span><strong>DEF:</strong> <?php echo $pet->pet_defense ?></span>
                        <span><strong>HP:</strong> <?php echo $pet->pet_hp ?></span>
                        <span><strong>EXP:</strong> <?php echo $pet->pet_xp ?></span>
                        <span><?php echo $pet->pet_description ?></span>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>

        <div>
            <input type="submit" value="Create Account" class="btn btn-inverse" />
            <a class="btn" href="<?php echo site_url(); ?>">Back</a>

            <div class="msgcontainer">
                <div class="alert alert-error fade in ">

                    <span id="signup_message"></span>
                    <a class="close" href="#">&times;</a>
                </div>
            </div>
        </div>
    </div>
</form>
        </div> <!-- end: inner div -->
</div> <!-- end: main container -->
