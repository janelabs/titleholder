<a href="<?php echo 'main' ?>">Back</a>


<br><br>
<a href="<?php echo 'logs/battle/monsters' ?>" class="log_nav">Monsters</a>
<a href="<?php echo 'logs/battle/players' ?>" class="log_nav">Players</a>

<div id="logs_window"></div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#logs_window').html('Loading content...');
        $('#logs_window').load("<?php echo site_url('logs/battle/monsters'); ?>");
    });
</script>