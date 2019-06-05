<?php

class Connection
{
    private $dsn;
    private $username;
    private $password;
    private $options;
    public $conn;

    public function __construct($config)
    {
        $this->dsn = $config['db_dsn'];
        $this->username = $config['db_user'];
        $this->password = $config['db_pass'];
        $this->options = $config['db_options'];
    }

    public function getConnect()
    {
        $this->conn = null;

        try{
            $this->conn = new PDO($this->dsn, $this->username, $this->password, $this->options);
        } catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}