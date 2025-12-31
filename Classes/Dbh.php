<?php
// A database class to connect to mysql database using PDO.
class Dbh
{
    // Connect function that uses PDO to connect to mysql and catches any errors.
    protected function connect()
    {
        $config = require __DIR__ . '/../config/db.php';
        
        try {
            $pdo = new PDO(
                "mysql:host={$config['host']};dbname={$config['db']}",
                $config['user'],
                $config['pass']
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Database connection failed");
        }
    }
}
