<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
    <head>
        <title>TitleHolder CMS - Login</title>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/scripts/bootstrap/css/bootstrap.min.css'); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/cms_style.css'); ?>" />

        <script type="text/javascript" src="<?php echo base_url('assets/scripts/jquery.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/scripts/bootstrap/js/bootstrap.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/scripts/jscripts.js'); ?>"></script>
    </head>
    <body style="margin: 0; background-color: rgb(221, 221, 221);">
        <div class="row-fluid">
            <div class="span4 offset4 login">
                <h1>&nbsp;Admin Login</h1>
                <?php
                    if ($this->session->flashdata('login_error')):
                        ?>
                        <div class="alert alert-error">
                            <strong>Error: </strong><?php echo $this->session->flashdata('login_error'); ?>
                        </div>
                    <?php
                    endif;
                ?>

                <form name="login" method="post" action="<?php echo site_url('cms/authenticate'); ?>" class="form-actions frm">
                    <div class="controls-row">
                        <span class="span3"><label for="username">Username: </label></span>
                        <span class="span3"><input type="text" id="username" name="username" placeholder="Username" class="input-xlarge" /></span>
                    </div>

                    <div class="controls-row">
                        <span class="span3"><label for="password">Password:</label></span>
                        <span class="span3"><input type="password" id="password" name="password" placeholder="Password" class="input-xlarge" /></span>
                    </div>

                    <div class="controls-row">
                        <span class="span6"><input type="submit" id="submit" value="Login" class="btn btn-large btn-info" style="width: 380px" /></span>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>