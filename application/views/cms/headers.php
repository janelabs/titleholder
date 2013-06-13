<!DOCTYPE html>

<html>
<head>
    <title>TitleHolder - CMS</title>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/scripts/bootstrap/css/bootstrap.min.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>" />

    <script type="text/javascript" src="<?php echo base_url('assets/scripts/jquery.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/scripts/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/scripts/jscripts.js'); ?>"></script>

</head>

<body style="margin: 0; background-color: rgb(221, 221, 221);">
<div class="row-fluid">
    <div class="span12">
        <div class="navbar">
            <div class="navbar-inner">
                <a class="brand" href="#">TitleHolder</a>
                <ul class="nav">
                    <li class="<?php echo ($active == 'admin') ? 'active' : ''; ?>"><a href="#">Admin</a></li>
                    <li class="<?php echo ($active == 'user') ? 'active' : ''; ?>"><a href="#">Users</a></li>
                    <li class="<?php echo ($active == 'avatar') ? 'active' : ''; ?>"><a href="#">Avatars</a></li>
                    <li class="<?php echo ($active == 'pet') ? 'active' : ''; ?>"><a href="#">Pets</a></li>
                    <li class="<?php echo ($active == 'monster') ? 'active' : ''; ?>"><a href="#">Monsters</a></li>
                    <li class="<?php echo ($active == 'title') ? 'active' : ''; ?>"><a href="#">Titles</a></li>
                    <li class=""><a href="<?php echo site_url('cms/logout'); ?>">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="span12">