<!DOCTYPE html>
<html>
<head>
    <title>Log In</title>
    <link rel="stylesheet" href="pub/css/bootstrap.css">
    <link rel="stylesheet" href="pub/css/bootstrap.min.css">
</head>
<body>
<div>
    <div class="container">
        <div class="jumbotron">
            <h1>Log In to the gallery</h1>
            <p>Enter your login and password to upload and delete the images</p>
        </div>
        <div>
            <a class="btn btn-dark" href="/">Go home</a><p>
        </div>
        <?php if ($errors): ?>
            <div class="alert alert-danger">
                <strong>Error:&nbsp;</strong><?php echo $errors ?>
            </div>
        <?php endif; ?>
        <form action="/processLogin" method="post">
            <div class="form-group">
                <label for="login">Enter Login</label>
                <input type="text" class="form-control" id="login" name="login" placeholder="Enter login here" value="<?php echo App::get('session')->getFieldValue('login') ?>">
            </div>
            <div class="form-group">
                <label for="pass">Enter Password</label>
                <input type="password" class="form-control" id="pass" name="pass" placeholder="Enter password here">
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember me</label>
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