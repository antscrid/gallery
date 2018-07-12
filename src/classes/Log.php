<?php
class Log
{
    const ERRORS_LOG = 'var/error.log';
    public function write($error)
    {
        error_log($error, 3, $_SERVER['DOCUMENT_ROOT'] . self::ERRORS_LOG);
    }
}