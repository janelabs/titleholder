<?php
    echo $header;
echo "<pre>";
var_dump($user);
echo "</pre>";
?>
<div id="div_main">

    <!-- avatar -->
    <div class="div_child">
        <img id="user_dp" src="<?php echo base_url('assets/images/dummy.png'); ?>" />
    </div>

    <!-- pet -->
    <div class="div_child">
        <img id="user_pet" src="<?php echo base_url('assets/images/p_01.gif'); ?>" />
    </div>

    <!-- stats -->
    <div class="div_child user_stat">
        <table border="0px" class="status" cellpadding="3" cellspacing="3">
            <tr>
                <td>HP: </td>
                <td class="td_elem"><?php echo $user['user_hp']; ?></td>
            </tr>
            <tr><td></td></tr>
            <tr>
                <td>Level: </td>
                <td class="td_elem"><?php echo $user['user_lvl']; ?></td>
            </tr>
            <tr><td></td></tr>
            <tr>
                <td>Experience: </td>
                <td class="td_elem"><?php echo $user['prev_xp']; ?></td>
            </tr>
            <tr><td></td></tr>
            <tr>
                <td>Attack: </td>
                <td class="td_elem"><?php echo $user['user_atk']; ?></td>
            </tr>
            <tr><td></td></tr>
            <tr>
                <td>Defense: </td>
                <td class="td_elem"><?php echo $user['user_def']; ?></td>
            </tr>
        </table>
    </div>

    <!-- menu -->
    <div class="div_child">
        <button>RANKS</button>
        <button>LOGS</button>
    </div>

</div>