<?php
error_reporting(E_ALL | E_STRICT);
spl_autoload_register(function ($classname) {
    require_once('src/classes/' . $classname . '.php');
});