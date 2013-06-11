<div id="logs_window" class="container2" style="width: 640px; height: 480px"></div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#logs_window').html('Loading content...');
        $('#logs_window').load("<?php echo site_url('logs/battle/monsters'); ?>");
    });
</script>