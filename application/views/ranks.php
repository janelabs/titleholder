

<div class="container">
    <div class="page-header">
        <h1>Rankings</h1>
    </div>


            <ul class="nav nav-tabs" id="rankTab">
                <li class="active"><a href="#title">By Title</a></li>
                <li><a href="#level">By Level</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="title">
                    <?php
                    // FIXME: repeating code, enhance
                    $i=0;
                    foreach($ranks as $rank) {
                        $i++;
                        ?>
                        <?php ?><div class="<?php echo $i==1?"toptitleholder":"titleholder"; ?>"><img src="<?php echo base_url('assets/Graphics/Characters/'.$rank->avatar_filename); ?>"><div class="rankname"><?php echo $rank->name; ?></div><div class="ranknumber"><?php echo $rank->r; ?></div></div>
                    <?php
                    }
                    ?>
                </div>
                <div class="tab-pane" id="level">
                    <?php
                    // FIXME: repeating code, enhance
                    $i=0;
                    foreach($r_level as $level) {
                        $i++;
                        ?>
                        <?php ?><div class="<?php echo $i==1?"toptitleholder":"titleholder"; ?>"><img src="<?php echo base_url('assets/Graphics/Characters/'.$level->avatar_filename); ?>"><div class="rankname">
                            <?php echo $level->name; ?></div><div> Lvl: <?php echo $level->level; ?></div></div>
                    <?php
                    }
                    ?>
                </div>

            </div>

</div>