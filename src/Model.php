<?php
namespace Hossam\ActionsNextJs;

class Model
{
    private $host = 'localhost';
    private $dbname = 'actions';
    private $user = 'root';
    private $pass = '';
    private $connection;
    private $stmt;

    public function __construct()
    {
        $dns = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        try {
            $this->connection = new \PDO($dns, $this->user, $this->pass);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function query($query)
    {
        $this->stmt = $this->connection->prepare($query);
        return $this;
    }

    public function execute($execute = [])
    {
        $this->stmt->execute($execute);
        return $this;
    }

    public function getStmt()
    {
        return $this->stmt;
    }
}

?>