<div class="container2" width="80%">
<h1 class="rank_txt">Rankings</h1>

<div class="tbl" style="width: 542px; left: 50px; top: 65px; height: 370px;">&nbsp;</div> <!-- DON'T DELETE THIS DIV, used in bg -->

<ul class="nav nav-tabs ul_nav" id="rankTab" style="width: 85%;">
    <li class="active" style="width: 50%;">
        <a href="#title"><h5>Title</h5></a>
    </li>
    <li style="width: 50%;">
        <a href="#level"><h5>Level</h5></a>
    </li>
</ul>

<div class="tab-content">
    <!-- by title -->
    <div class="tab-pane active tab_position" id="title" style="width: 100%;">
        <table style="width: 85%;" cellpadding="5" cellspacing="0" border="0px" class="tbl_text tbl_position">
            <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Titles</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    $i = 0;
                    if ($ranks):
                        foreach($ranks as $rank):
                            $i++;
                            ?>
                            <tr>
                                <td>
                                    <!-- $rank->avatar_filename -->
                                    <img width="40px" height="40px" src="<?php echo base_url('assets/images/placeholder.jpg'); ?>" />
                                </td>
                                <td>
                                    <?php echo $rank->name; ?>
                                </td>
                                <td>
                                    <?php echo $rank->r; ?>
                                </td>
                            </tr>
                            <?php
                        endforeach;
                    else:
                        ?>
                        <tr colspan="3">
                            <td>No result!</td>
                        </tr>
                        <?php
                    endif;
                ?>
            </tbody>
        </table>
    </div>

    <!-- by level -->

    <div class="tab-pane tab_position" id="level" style="width: 100%;">
        <table style="width: 85%;" cellpadding="5" cellspacing="0" border="0px" class="tbl_text tbl_position">
            <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Level</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $i = 0;
            if ($r_level):
                foreach($r_level as $level):
                    $i++;
                    ?>
                    <tr>
                        <td>
                            <!-- $level->avatar_filename -->
                            <img width="40px" height="40px" src="<?php echo base_url('assets/images/placeholder.jpg'); ?>" />
                        </td>
                        <td>
                            <?php echo $level->name; ?>
                        </td>
                        <td>
                            <?php echo $level->level; ?>
                        </td>
                    </tr>
                <?php
                endforeach;
            else:
                ?>
                <tr colspan="3">
                    <td>No result!</td>
                </tr>
            <?php
            endif;
            ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</body>
</html>