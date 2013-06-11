<form action="<?php echo site_url() . 'login' ?>" method="post" id="login">
<div>
    <input type="text" name="email"  placeholder="email" />
</div>
<div>
    <input type="password" name="password" placeholder="password" />
</div>
<div>
    <input type="submit" id="login-btn"  class="btn btn-primary" data-loading-text="Processing..." value="Login" autocomplete="off" />
    <!--<input type="submit" value="login">-->
    <div class="msgcontainer">
    <div class="alert alert-error fade in ">

    <span id="login_message"></span>
        <a class="close" href="#">&times;</a>
    </div>
    </div>
</div>
</form>

</body>
</html>