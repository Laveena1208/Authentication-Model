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
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }

    public function raw(string $query)
    {
        $this->pdo->query($query);
    }

    public function fetchAll(string $query, int $fetchMode = PDO::FETCH_ASSOC)
    {
        return $this->pdo->query($query)->fetchAll($fetchMode);
    }

    public function table(string $table):Database
    {
        $this->table = $table;
        return $this;
    }

    public function update(array $data, array $whereCondition)
    {
        $keys = array_keys($data);//['first_name', 'last_name']
        $set = "";
        forEach($keys as $index=>$key)
        {
            if($index !=0)
            {
                $set .= ", ";
            }
            $set .= "{$key} = :{$key}";
        }
        //setting 'and' where logic
        $keys = array_keys($whereCondition);
        $condition = "";
        forEach($keys as $index=>$key)
        {
            if($index !=0)
            {
                $condition .= " AND ";
            }
            $condition .= "{$key} = :{$key}";
        }
        $sql = "UPDATE {$this->table} SET {$set} WHERE {$condition}";

        $meregerdArrayForExec = array_merge($data, $whereCondition);
        $this->ps = $this->pdo->prepare($sql);
        return $this->ps->execute($meregerdArrayForExec);
    
    }
    public function orWhere(array $data)
    {
        $keys = array_keys($data);
        $condition = "";
        foreach($keys as $index=>$key)
        {
            if($index != 0)
            {
                $condition .=" OR ";
            }
            $condition .="{$key} = :$key";
        }
        $sql = "SELECT * FROM {$this->table} WHERE $condition";
        $this->ps = $this->pdo->prepare($sql);
        $this->ps->execute($data);
        return $this;
    }

    public function andWhere(array $data)
    {
        $keys = array_keys($data);
        $condition = "";
        foreach($keys as $index=>$key)
        {
            if($index != 0)
            {
                $condition .=" AND ";
            }
            $condition .="{$key} = :$key";
        }
        $sql = "SELECT * FROM {$this->table} WHERE $condition";
        $this->ps = $this->pdo->prepare($sql);
        $this->ps->execute($data);
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