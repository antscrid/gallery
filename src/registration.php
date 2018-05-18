<!DOCTYPE html>
<html>
<body>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<?php
if (isset($_POST['login']) && isset($_POST['password']) &&
    !empty($_POST['login']) && !empty($_POST['password']))
{
    $access = array();
    $access = file("userdata.txt");
    $l = count($access);
    $temp = false;
    for($i=1;$i<$l;$i++)
    {
        list($login) = explode("||", $access[$i]);
        if($login==$_POST["login"]) {$temp=true; break;}
    }
    if(!$temp)
    {
        $text=$_POST['login'].'||'.$_POST['password']."\n";
        $fh = fopen('userdata.txt', 'a');
        fwrite($fh, $text);
        fclose($fh);
        echo '<script type="text/javascript">alert(\'Signed up successfully\')</script>' &&
        header ('Location: ../index.php');
    }
}
    if($temp)
    {
    echo '<script type="text/javascript">alert(\'Login '.$_POST['login'].' occupied!\')</script>';
    }
?>
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
                                    <input type="submit" class="btn btn-lg btn-primary btn-block" value="Create the new user">
                                </div>
                                </div>
                            </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>>
</body>
</html>
