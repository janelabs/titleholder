<?php echo $header; ?>

<script type="text/javascript" src="<?php echo base_url('assets/scripts/module/cms_user.js'); ?>"></script>

<div class="row-fluid">
    <div class="span8 offset1">

        <?php
        if ($this->session->flashdata('error')):
            ?>
            <div class="alert alert-error">
                <strong>Error: </strong><?php echo $this->session->flashdata('login_error'); ?>
            </div>
        <?php
        endif;
        ?>

        <h3>Registered Users:</h3>
        <div>
            <!--<button>Edit Selected</button>-->
            <button id="delete">Delete Selected</button>
        </div><br />
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
        CmsUsers.initView();
    });
</script>