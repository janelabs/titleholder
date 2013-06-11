
<table cellpadding="5" cellspacing="0" border="1">
    <thead>
    <tr>
        <th>Name</th>
        <th>Level</th>
        <th>Result</th>
    </tr>
    </thead>
    <tbody>
    <?php if($logs): ?>
    <?php foreach($logs as $log): ?>
    <tr>
        <td><?php echo $log['name'] ?></td>
        <td><?php echo $log['level'] ?></td>
        <td><?php echo $log['result'] ?></td>
    </tr>
    <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="3" align="center">There are no logs</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>