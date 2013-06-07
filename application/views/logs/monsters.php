
<table cellpadding="5" cellspacing="0" border="1">
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
            <td><?php echo $log['avatar'] ?></td>
            <td><?php echo $log['name'] ?></td>
            <td><?php echo $log['result'] ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>