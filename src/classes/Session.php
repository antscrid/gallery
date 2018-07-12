<?php
class Session
{
    public function __construct()
    {
        session_start();
    }
    //getting the notifications array
    public function getMessages()
    {
        if (isset($_SESSION['messages']) && !empty($_SESSION['messages'])) {
            $messages = '';
            foreach ($_SESSION['messages'] as $message) {
                $messages .= $message . '<br>';
            }
            unset($_SESSION['messages']);
            return $messages;
        }
        return false;
    }
    //getting the notifications array
    public function getErrors()
    {
        if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
            $errors = '';
            foreach ($_SESSION['errors'] as $error) {
                $errors .= $error . '<br>';
            }
            unset($_SESSION['errors']);
            return $errors;
        }
        return false;
    }

    public function clear()
    {
        $_SESSION = [];
    }
    public function setMessage($message)
    {
        $_SESSION['messages'][] = $message;
    }
    public function setError($error)
    {
        $_SESSION['messages'][] = $error;
    }
    public function messages()
    {
        return $this->getMessages() . $this->getErrors();
    }
    public function isLoggedIn()
    {
        if (isset($_SESSION['auth']) && !empty($_SESSION['auth'])) {
            return true;
        }
        return false;
    }
    public function getFieldValue($field)
    {
        if (isset($_SESSION['fields'][$field])) {
            return $_SESSION['fields'][$field];
        }
        return '';
    }
}