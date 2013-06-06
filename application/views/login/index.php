<form action="<?php echo site_url() . 'login' ?>" method="post" id="login">
<div>
    <input type="text" name="email" placeholder="email" />
    <span id="email" class="vspan"></span>
</div>
<div>
    <input type="password" name="password" placeholder="password" />
    <span id="password" class="vspan"></span>
</div>
<div>
    <input type="submit" value="login">
    <span id="login_message"></span>
</div>
</form>
