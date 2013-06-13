<?php echo $header; ?>

<script type="text/javascript" src="<?php echo base_url('assets/scripts/module/cms_user.js'); ?>"></script>

<style type="text/css">
    .centerText {
        text-align: center;
    }
</style>

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
            <button class="btn btn-info" id="edit">Edit Selected</button>
            <button class="btn btn-danger" id="delete">Delete Selected</button>
        </div><br />
        <div id="list">
            <table id="u_list"></table>
            <div id="pager"></div>
            <?php echo $user_list; ?>
        </div>
    </div>
    <p id="site_url" style="display: none"><?php echo site_url(); ?></p>
</div>

<div id="edit_user" class="modal hide fade">
    <form name="edituser" id="edituser" action="<?php echo site_url('cms/users/edit'); ?>">
        <div class="modal-body">
            Name: <input type="text" name="uname" id="uname" /><br>

            <input type="checkbox" id="password" name="password" /> Generate new password?

            <input type="hidden" id="email" name="email" />
            <input type="hidden" id="uid" name="uid" />
        </div>

        <div class="modal-footer">
            <a class="btn btn-info" data-dismiss="modal">CANCEL</a>
            <input type="button" id="saveEdit" value="SAVE" class="btn btn-danger" />
        </div>
    </form>
</div>

<?php echo $footer; ?>

<script type="text/javascript">
    $(function(){
        CmsUsers.initView();
    });
</script>