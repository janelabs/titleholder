<div class="tbl"></div>
<table width="80%" cellpadding="5" cellspacing="0" border="0px" class="table-bordered tbl_text tbl_position">
    <thead>
    <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Result</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($logs as $log): ?>
        <tr>
            <td class="enemy_image"><img src="<?php echo base_url('assets/images/placeholder.jpg'); ?>" /></td><?php //echo $log['avatar'] ?>
            <td><?php echo $log['name'] ?></td>
            <td><?php echo $log['result'] ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>