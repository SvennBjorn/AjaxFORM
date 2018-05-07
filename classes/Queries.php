<?php

class Querie
{
    private $dsn = "mysql:dbname=ajaxForm;host=localhost;charset=utf8";
    private $user = "root";
    private $password = "";
    private $db;

    public function __construct()
    {
        try {
            $this->db = new PDO($this->dsn, $this->user, $this->password);
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        }

        catch (PDOException $e) {
            Log::logWrite($e->getMessage());
        }
    }

    public function selectMethod($sql)
    {
        if (strlen($sql) > 0 || !empty($sql)) {
            $result = $this->db->prepare($sql);
            $result->execute();
            return $result->fetchAll();
        }

        else {
            return false;
        }
    }

    public function __destruct()
    {
        unset($this->db);
    }
}