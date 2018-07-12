<?php
final class Database
{
    //configuration file to constant
    const DB_CONFIGURATION = 'var/config.ini';

    private static $pdo;
    //connecting to DB with PDO
    public static function connect()
    {
        if (null === static::$pdo) {
            try {
                if (file_exists(self::DB_CONFIGURATION)) {
                    $config = parse_ini_file(self::DB_CONFIGURATION);
                    static::$pdo = new PDO(
                        $config['engine'] . ':host=' . $config['host'] . ';dbname=' . $config['dbname'], $config['user'], $config['pass']);
                } else {
                    throw new Exception('Config file is not exist');
                }
            } catch (PDOException $exception) {
                App::get('log')->write($exception->getMessage());
                echo 'Could not connect to DB';
                exit;
            } catch (Exception $exception) {
                App::get('log')->write($exception->getMessage());
                echo 'Could not connect to DB';
                exit;
            }
        }
        return static::$pdo;
    }

}