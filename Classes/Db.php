<?php



class Db {
    private $servername;
    private $username;
    private $password;
    private $dbname;

    public function __construct() {
        $this->servername = 'localhost';
        $this->username = 'root';
        $this->password = '';
        $this->dbname = 'tutoriffic';
    }

    private static $instance = null;

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function con() {
        $config = require __DIR__ . '/../config.php';
        $server = $_SERVER['SERVER_NAME'];

        if($server == 'localhost') {
            $this->servername = $config['DB_SERVER_LOCAL'];
            $this->username = $config['DB_USER_LOCAL'];
            $this->password = $config['DB_PASS_LOCAL'];
            $this->dbname = $config['DB_NAME_LOCAL'];
        } else {
            $this->servername = $config['DB_SERVER_PROD'];
            $this->username = $config['DB_USER_PROD'];
            $this->password = $config['DB_PASS_PROD'];
            $this->dbname = $config['DB_NAME_PROD'];
        }

        try {
            $con = new \mysqli(
                $this->servername, 
                $this->username, 
                $this->password, 
                $this->dbname
            );

            if ($con->connect_error) {
                throw new \Exception("Connection failed: " . $con->connect_error);
            }

            return $con;
        } catch (\Exception $e) {
            die("Connection error: " . $e->getMessage());
        }
        return $con;

    }
}