<?php
class Dbh_class
{
    protected $dbh;
    private $stmt;
    protected function connect()
    {
        try {
            $username = "root";
            $password = "";
            $dbh = new \PDO('mysql:host:localhost;port=3306;dbname=Chess_Log', $username, $password);
            return $dbh;
        } catch (PDOException $err) {
            print("error" . $err->getMessage() . "\n");
            die();
        };
    }
    protected function session_connect()
    {
        $options = array(
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
        );
        $username = "root";
        $password = "";
        try {
            $this->dbh = new \PDO('mysql:host:localhost;port=3306;dbname=Chess_Log', $username, $password, $options);
        } catch (PDOException $err) {
            print("error" . $err->getMessage() . "\n");
            die();
        }
    }
    protected function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }
    protected function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }
    protected function execute()
    {
        return $this->stmt->execute();
    }

    protected function resultset()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function rowCount()
    {
        return $this->stmt->rowCount();
    }

    protected function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }

    protected function beginTransaction()
    {
        return $this->dbh->beginTransaction();
    }

    protected function endTransaction()
    {
        return $this->dbh->commit();
    }

    protected function cancelTransaction()
    {
        return $this->dbh->rollBack();
    }

    protected function debugDumpParams()
    {
        return $this->stmt->debugDumpParams();
    }

    protected function close()
    {
        $this->dbh = null;
    }
}