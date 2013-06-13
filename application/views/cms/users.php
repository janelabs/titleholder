<?php echo $header; ?>

<script type="text/javascript" src="<?php echo base_url('assets/scripts/module/cms_user.js'); ?>"></script>

<div class="row-fluid">
    <div class="span8 offset1">
        <h3>Registered Users:</h3>
        <div id="list">
            <table id="u_list"></table>
            <div id="pager"></div>
            <?php echo $user_list; ?>
        </div>
    </div>
    <p id="site_url" style="display: none"><?php echo site_url(); ?></p>
</div>

<?php echo $footer; ?>

<script type="text/javascript">
    $(function(){
        CmsUsers.gridComplete();
    });
</script>