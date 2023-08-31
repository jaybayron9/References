<?php  
namespace DBConn;
use PDO;
use Exception;
use PDOException;

class DBConn {
    protected $db;

    public function __construct() {
        try { 
            $dsn = "mysql:host=localhost;dbname=cjce;charset=utf8mb4";
            $this->db = new PDO($dsn, 'root', '', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (Exception $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public function __destruct() {
        $this->db = null;
    }

    public function insert($table, $data) {
        $columns = implode(', ', array_keys($data));
        $values = implode(', ', array_fill(0, count($data), '?'));

        $qry = $this->db->prepare("
            INSERT INTO $table ($columns) VALUES ($values)
        ");
        $qry->execute(array_values($data));
    }

    public function select($table, $columns = '*', $where = null, $orderBy = null, $limit = null) {
        $query = "SELECT $columns FROM $table"; 
        
        if ($where) {
            $conditions = [];
            foreach ($where as $column => $value) {
                $conditions[] = "$column = :$column";
            }
            $query .= " WHERE " . implode(' AND ', $conditions);
        }
        
        if ($orderBy) {
            $query .= " ORDER BY $orderBy";
        }
        
        if ($limit) {
            $query .= " LIMIT $limit";
        }
        
        $stmt = $this->db->prepare($query);
        $stmt->execute($where);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    

    public function DBQuery($query) {
        try {
            $stmt = $this->db->query($query);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo 'Query failed: ' . $e->getMessage();
        }
    }
}  
