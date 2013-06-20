<form action="<?php echo site_url() . 'login' ?>" method="post" id="login">
<div>
    <input type="text" name="email"  placeholder="email" id="email" />
</div>
<div>
    <input type="password" name="password" placeholder="password" id="password" />
</div>
<div>
    <input type="submit" id="login_message" class="btn btn-primary" data-loading-text="Processing..." value="Login" autocomplete="off" />
    <!--<input type="submit" value="login">-->

</div>
</form>

</body>
</html>