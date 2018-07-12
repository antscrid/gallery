<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>Log In and Sign Up here</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="pub/css/style.css">
    <link href="http://bootstrap-3.ru/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://bootstrap-3.ru/examples/blog/blog.css" rel="stylesheet">
    <script src="../pub/js/form_animation.js"></script>
</head>
<body>
<div class="album py-5 bg-light">
    <div class="container">
        <h1 class="h1 text-center">Create account or Log in here</h1>
        <?php if ($errors): ?>
            <div class="alert alert-danger">
                <strong>Error:&nbsp;</strong><?php echo $errors ?>
            </div>
        <?php endif; ?>
<div class="container">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="login-form-link">Log In</a>
							</div>
							<div class="col-xs-6">
								<a href="#" id="register-form-link">Sign Up</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="/processLogin" method="post"style="display: block;">
									<div class="form-group">
										<input type="text" name="login" id="login" class="form-control" placeholder="Login" value="">
									</div>
									<div class="form-group">
										<input type="password" name="pass" id="pass" tabindex="2" class="form-control" placeholder="Password">
									</div>
									<div class="form-group text-center">
										<input type="checkbox" class="" name="remember" id="remember">
										<label for="remember"> Remember Me</label>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login" id="login" class="form-control btn btn-login" value="Log In">
											</div>
										</div>
									</div>
								</form>
								<form id="register-form" action="/processRegister" method="post" role="form" style="display: none;">
									<div class="form-group">
										<input type="text" name="login" id="login" class="form-control" placeholder="Login" value="">
									</div>
									<div class="form-group">
										<input type="password" name="pass" id="pass" class="form-control" placeholder="Password">
									</div>
									<div class="form-group">
										<input type="password" name="repass" id="repass" class="form-control" placeholder="Confirm Password">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Sign Up now">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
