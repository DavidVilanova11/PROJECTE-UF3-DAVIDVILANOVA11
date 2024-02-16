<?php


class Database
{
    private $connection;
    private $db_host;
    private $db_name;
    private $db_user;
    private $password;


    public function __construct()
    {
        $this->db_host = $_ENV['DB_HOST'];
        $this->db_name = $_ENV['DB_NAME'];
        $this->db_user = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASSWORD'];

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        
        $this->connection = new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user, $this->password, $options);

        $this->connection->exec("SET CHARACTER SET UTF8");
    }

    public function getConnection()
    {
        return $this->connection;
    }



    public function closeConnection()
    {
        $this->connection = null;
    }

    public function queryDataBase($sql, $params = null, $id = false)
    {
        
        try {
            $statement = $this->connection->prepare($sql);
            if($params != null) {
                $success = $statement->execute($params);
            } else {
                $success = $statement->execute();
            }
            if($id){
                $result = $this->connection->lastInsertId();
            }else{
                $result = $statement;
            }
            self::closeConnection();
            return $result;


        } catch (Exception $ex) {
            $error = $ex->getMessage();
            echo $ex->getMessage();
            self::closeConnection();
            return null;
        }

    }


}