<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="pub/css/bootstrap.css">
    <link rel="stylesheet" href="pub/css/bootstrap.min.css">
</head>
<body>
<div>
    <div class="container">
            <div class="jumbotron">
                <h1>Sign up to the gallery</h1>
                <p>Create the user by entering the login and password</p>
            </div>
        <div>
            <a class="btn btn-dark" href="/">Go home</a><p>
        </div>
        <?php if ($errors): ?>
            <div class="alert alert-danger">
                <strong>Error:&nbsp;</strong><?php echo $errors ?>
            </div>
        <?php endif; ?>
        <form action="/processRegister" method="post">
            <div class="form-group">
                <label for="login">Enter Login</label>
                <input type="text" class="form-control" id="login" name="login" placeholder="Enter login here" value="<?php echo App::get('session')->getFieldValue('login') ?>">
            </div>
            <div class="form-group">
                <label for="pass">Enter Password</label>
                <input type="password" class="form-control" id="pass" name="pass" placeholder="Enter password here">
            </div>
            <div class="form-group">
                <label for="repass">Check the password </label>
                <input type="password" class="form-control" placeholder="Enter the password again" id="repass" name="repass">
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>