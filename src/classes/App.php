<?php
class App
{
    //constructor
    public function __construct()
    {
        set_error_handler(array($this, 'errorHandler'), -1);
        set_exception_handler(array($this, 'exceptionHandler'));
        register_shutdown_function(array($this, 'shutDown'));
        $this->get('session');
    }
    //application startup
    public function run()
    {
        $page = new Page($_GET);
        $page->load();
    }
    //logging the errors
    public function errorHandler($errorNo, $errorMessage, $errorFile, $errorLine)
    {
        $error = 'Error level: ' . $errorNo . ' Text: ' . $errorMessage . ' in file: ' . $errorFile . ' on line: ' . $errorLine . "\n";
        App::get('log')->write($error);
    }
    //showing the page with errors
    public function shutDown()
    {
        if ($error = error_get_last()) {
            App::get('log')->write($error['message']);
            require($_SERVER['DOCUMENT_ROOT'] . 'view/error.php');
        }
    }
    public function exceptionHandler($e)
    {
        App::get('log')->write($e->getMessage());
        require($_SERVER['DOCUMENT_ROOT'] . 'view/error.php');
    }
    //getting the classes names
    public static function get($className)
    {
        if (!isset(self::$di[$className])) {
            $class = ucwords($className);
            self::$di[$className] = new $class;
        }
        return self::$di[$className];
    }
    private static $di = [];
}