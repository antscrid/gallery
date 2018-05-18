<?php 
function login_function(){
if (isset($_POST['logout'])) {
    unset($_SESSION['login']);
}
if (isset($_POST['login']) && isset ($_POST['password'])) {
    $access = array();
    $access = file("../src/userdata.txt");
    $l = count($access);
    for ($i = 1; $i < $l; $i++) {
        $access[$i] = trim($access[$i]);
        list($login, $passw) = explode("||", $access[$i]);
        $temp = 0;

        if (($_POST['login'] == $login) && ($_POST['password'] == $password)) {
            $_SESSION['login'] = $login;
            $temp = 1;
            break;
        }
    }
}
if (empty($_SESSION['login'])) {
    echo '
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<div class=container-fluid">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="" method="post" role="form" style="display: block;">
									<div class="form-group">
										<input type="text" name="login" id="login" tabindex="1" class="form-control" placeholder="Login" value="">
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
									</div>
									<div class="row">
					                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <input type="submit" class="btn btn-lg btn-success btn-block" value="Sign In">
					                </div>
					                <div class="col-xs-6 col-sm-6 col-md-6">
						            <a href="src/registration.php" class="btn btn-lg btn-primary btn-block">Create the new user</a>
					                </div>
				                    </div>
										</div>
									</div>
									</form>
							</div>
						</div>
					</div>
		
';
} else {
    echo $_SESSION['login'] . ', Welcome to the gallery<p align=left><br>
<a id="v" href="registration.php">Sign up again</a>
<br><div align=right><a id="d" href="?logout">Log out</a></div>
<div class="container">
        <a class="btn btn-dark btn-lg active m-md-2" href="/form">Upload New Image</a>';
}
if (isset($temp)) {
    if ($temp == 1) {
        echo '<script language="JavaScript"> alert(\'Log In successful\'); </script>';
    }
    if ($temp == 0) {
        echo '<script language="JavaScript"> alert(\'Invalid login or password\'); </script>';
    }
}
};