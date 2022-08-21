<!-- Login Form start-->
<div id="loginForm">
	<h2>Admin Login</h2>
    <form class="form-horizontal" role="form" method="post">
        <div class="form-group">
            <label class="col-sm-2 control-label" for="username">Username</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="username" name="username" placeholder="Username">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="Password">Password</label>
            <div class="col-sm-10">
            	<input type="password" class="form-control" id="Password" name="password" placeholder="Password">
            </div>
        </div>
        <?php if($success == 0){?>
		<p class="text-danger">Incorrent username or password</p>
        <?php }?>
        <div class="form-group">
        	<div class="col-sm-offset-2 col-sm-10">
        		<button type="submit" name="submit" class="btn btn-default">Login</button>
            </div>
        </div>
    </form>
</div>
<!-- Login form end -->