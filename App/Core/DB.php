<?php
namespace App\Core;

class DB{

    public static $instance;
    private $hostname = 'localhost';
    private $dbName = 'atendimento';
    private $username = 'root';
    private $password = '';
    private $connection;
    private $query = '';

    private function __construct()
    {
        $this->connection = mysqli_connect($this->hostname, $this->username, $this->password, $this->dbName);

        mysqli_set_charset($this->connection, "utf8");

        if (! $this->connection){
            die('Não foi possível estabelecer uma conexão com o banco de dados: ' . mysqli_error());
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new DB;
        }

        return self::$instance;
    }

    function __destruct()
    {
        mysqli_close($this->connection);
    }

    public function sqlSelect($sql)
    {
        $this->query = $sql;
        return $this->fetchAll();
    }

    public function rawSql($sql)
    {
        $this->query = $sql;
        return $this->run();
    }

    public function run()
    {
        // echo $this->query; die();
        $result = mysqli_query($this->connection, $this->query) or die (mysqli_error($this->connection));
        $this->query = '';
        return $result;
    }

    public function fetchAll()
    {
        if ($result = $this->run()){
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        return [];
    }

    public function select($fields){
        $this->query = 'SELECT '.$fields;
        return $this;
    }

    public function from($table){
        $this->query .= ' FROM '.$table;
        return $this;
    }

    public function where($field, $compare, $value){
        $this->query .= " WHERE {$field} {$compare} {$value}";
        return $this;
    }

    public function andWhere($field, $compare, $value){
        $this->query .= " AND {$field} {$compare} {$value}";
        return $this;
    }

    public function limit($number){
        $this->query .= " LIMIT {$number}";
        return $this;
    }

    public function orderBy($fields){
        $this->query .= ' ORDER BY '.$fields;
        return $this;
    }

    private function sanitizeData($value)
    {
        $value = htmlspecialchars($value);

        if (! is_numeric($value)){
            $value = '"'.addslashes($value).'"';
        }

        return $value;
    }

    public function insert($table, $data)
    {
        $fields_arr = [];
        $values_arr = [];

        foreach ($data as $field => $value){
            $fields_arr[] = $field;
            $values_arr[] = $this->sanitizeData($value);
        }

        $fields = implode(', ', $fields_arr);
        $values = implode(', ',$values_arr);

        $this->query = "INSERT INTO {$table} ({$fields}) VALUES ({$values})";

        return $this->run();
    }

    public function update($table)
    {
      $this->query .= ' UPDATE '.$table;
      return $this;
    }

    public function set($fields)
    {
      $values = '';

      foreach ($fields as $field => $value){
          $values .= $field .' = '. $this->sanitizeData($value).', ';
      }

      $this->query .= ' SET '.rtrim($values, ', ');

      return $this;
    }

    public function insertedId(){
        return mysqli_insert_id($this->connection);
    }
}
