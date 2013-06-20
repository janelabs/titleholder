<h1 class="log_txt">Logs</h1>
<div class="tbl">&nbsp;</div>
<table width="80%" cellpadding="5" cellspacing="0" border="0px" class="tbl_text tbl_position">
    <thead>
    <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Result</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if ($logs):
        foreach($logs as $log): ?>
            <tr>
                <td><img class="enemy_image" src="<?php echo base_url('assets/images/'.$log['avatar']); ?>" /></td><?php //echo $log['avatar'] ?>
                <td><?php echo $log['name'] ?></td>
                <td><?php echo $log['result'] ?></td>
            </tr>
    <?php endforeach;
    else:
        ?>
        <tr>
            <td colspan="3">No record(s) found.</td>
        </tr>
        <?php
    endif;
    ?>
    </tbody>
</table>