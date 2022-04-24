<?php
class Database
{
    protected string $host = 'localhost';
    protected int $port = 3360;
    protected string $database = 'addressbook';
    protected string $username = 'Laveena';
    protected string $password = 'laveena@';

    protected string $table;
    protected PDO $pdo;
    protected PDOStatement $ps;
    public function __construct()
    {
        $dsn = "mysql:host={$this->host};dbname={$this->database}";
        $this->pdo = new PDO($dsn, $this->username, $this->password);
    }

    public function table(string $table):Database
    {
        $this->table = $table;
        return $this;
    }

    public function where(string $field, string $operator, string $value):Database
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$field} {$operator} :value";
        $this->ps = $this->pdo->prepare($sql);
        $this->ps->execute(['value'=>$value]);
        return $this;
    }
    public function get():array
    {
        return $this->ps->fetchAll();
    }

    public function first()
    {
        return $this->get()[0];
    }

    public function insert(array $data)
    {
        $keys = array_keys($data);//['first_name','last_name']
        $fields = "`" . implode("`, `", $keys) .  "`";
        $placeholders = ":" . implode(", :", $keys);
        $sql = "INSERT INTO {$this->table} ($fields) VALUES ($placeholders)";
        $this->ps = $this->pdo->prepare($sql);
        return $this->ps->execute($data);
    }

    public function count():int
    {
        return $this->ps->rowCount();
    }

    public function exists($field, $value): bool
    {
        return $this->where($field, "=", $value) ->count() ? true : false;
    }
    public function deleteWhere($field, $value)
    {
        $sql = "DELETE FROM {$this->table} WHERE {$field}= :value";
        $this->ps = $this->pdo->prepare($sql);
        $this->ps->execute(['value'=>$value]);
        return $this;

    }
}