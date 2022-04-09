<?php
class Database
{
    protected $connection = null;
 
    public function __construct()
    {
                
    }
 
    public function select($query = "" , $params = [], $db = 1)
    {
        if ($db == 1)
        {
            try {
                $this->connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE_NAME);
                if ( mysqli_connect_errno()) 
                {
                    throw new Exception("Could not connect to database.");   
                }
            } 
            catch (Exception $e) 
            {
                throw new Exception($e->getMessage());   
            }
        }
        elseif ($db == 2)
        {
            try {
                $this->connection = new mysqli(DB_HOST1, DB_USERNAME1, DB_PASSWORD1, DB_DATABASE_NAME1);
                if ( mysqli_connect_errno()) 
                {
                    throw new Exception("Could not connect to database.");   
                }
            } 
            catch (Exception $e) 
            {
                throw new Exception($e->getMessage());   
            }
        } 
        else
        {
            $err = 0;
        }
        try {
            $stmt = $this->executeStatement( $query , $params ,$db);
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);               
            $stmt->close();
            return $result;
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }
        return false;
    }
 
    public function executeStatement($query = "" , $params = [], $db = 1)
    {
        if ($db == 1)
        {
            try {
                $this->connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE_NAME);
                if ( mysqli_connect_errno()) 
                {
                    throw new Exception("Could not connect to database.");   
                }
            } 
            catch (Exception $e) 
            {
                throw new Exception($e->getMessage());   
            }
        }
        elseif ($db == 2)
        {
            try {
                $this->connection = new mysqli(DB_HOST1, DB_USERNAME1, DB_PASSWORD1, DB_DATABASE_NAME1);
                if ( mysqli_connect_errno()) 
                {
                    throw new Exception("Could not connect to database.");   
                }
            } 
            catch (Exception $e) 
            {
                throw new Exception($e->getMessage());   
            }
        } 
        else
        {
            $err = 0;
        }
        try {
            $stmt = $this->connection->prepare( $query );
 
            if($stmt === false) {
                throw New Exception("Unable to do prepared statement: " . $query);
            }
 
            if( $params ) {
                $stmt->bind_param($params[0], $params[1]);
            }
 
            $stmt->execute();
 
            return $stmt;
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }   
    }
}