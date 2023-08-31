<?php 

class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "mydatabase";
    private $pdo;
 
    public function __construct() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->database}";
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function create($table, $data) {
        $keys = implode(",", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO {$table} ({$keys}) VALUES ({$values})";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        return $this->pdo->lastInsertId();
    }

    public function read($table, $id) {
        $sql = "SELECT * FROM {$table} WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($table, $id, $data) {
        $sets = [];
        foreach ($data as $key => $value) {
            $sets[] = "{$key}=:{$key}";
        }
        $sets = implode(",", $sets);
        $sql = "UPDATE {$table} SET {$sets} WHERE id = :id";
        $data['id'] = $id;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        return $stmt->rowCount();
    }

    public function delete($table, $id) {
        $sql = "DELETE FROM {$table} WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }
}


$db = new Database();

// Create a record
$data = [
    'name' => 'John Doe',
    'email' => 'johndoe@example.com',
    'phone' => '555-1234'
];
$id = $db->create('users', $data);
echo "Created record with ID: {$id}\n";

// Read a record
$user = $db->read('users', $id);
echo "Read record:\n";
print_r($user);

// Update a record
$data = [
    'email' => 'newemail@example.com',
    'phone' => '555-5678'
];
$rows = $db->update('users', $id, $data);
echo "Updated {$rows} rows\n";

// Delete a record
$rows = $db->delete('users', $id);
echo "Deleted {$rows} rows\n";
