<?php
class User
{
    public $database;
    public function __construct()
    {
        $this->database = Database::connect();
    }
    //DB query for logging in
    protected function request($sql, $params = [])
    {
        $query = $this->database->prepare($sql);
        $result = $query->execute($params);
        if ($result === false) {
            error_log($query->errorInfo()[2], 3, $_SERVER['DOCUMENT_ROOT'] . Log::ERRORS_LOG);
            return false;
        }
        return $query;
    }
    //user verification
    public function create($login, $pass)
    {
        $pass = crypt($pass, $login);
        if ($this->request('INSERT INTO users(id, login, password) VALUES(NULL, :login, :pass)', array(':login' => $login, ':pass' => $pass))) {
            $_SESSION['auth'] = $this->database->lastInsertId();
            $_SESSION['messages'][] = 'Your account has been created';
            return true;
        }
        $_SESSION['errors'][] = 'Something went wrong';
        return false;
    }
    public function logout()
    {
        App::get('session')->clear();
    }
    //user verification
    function auth($postUser, $postPass)
    {
        $pass = crypt($postPass, $postUser);
        $result = $this->request('SELECT id FROM users WHERE login = :login AND password = :pass', [':login' => $postUser, ':pass' => $pass]);
        if ($result->rowCount() == 1) {
            $_SESSION['auth'] = $result->fetchColumn(0);
            $_SESSION['messages'] = ['Logged in successfully'];
            unset($_SESSION['fields']);
            return true;
        }
        $_SESSION['errors'] = ['Check your login'];
        $_SESSION['fields'] = $_POST;
        return false;
    }
}