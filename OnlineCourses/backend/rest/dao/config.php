<?php
class Database {
    private static $host = 'localhost:3306'; 
    private static $dbName = 'WebOnlineCourses';  
    private static $username = 'root';
    private static $password = '';
    private static $connection = null;

    public static function connect() {
        if (self::$connection === null) {
            try {
                self::$connection = new PDO(
                    "mysql:host=" . self::$host . ";dbname=" . self::$dbName,
                    self::$username,
                    self::$password,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
        return self::$connection;
    }
}

//JWT konfiguracija
class Config {
    public static function JWT_SECRET() {
        return 'adnamujic'; 
    }
}
?>
