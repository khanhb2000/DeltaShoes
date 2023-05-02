<?php

Trait Database {
    private function connect() {
        $string = "mysql:hostname=".DB_HOST.";dbname=".DB_NAME;
        $conn = new PDO($string, DB_USER, DB_PASS);
        return $conn;
    }

    public function query($query, $data = []) {
        $conn = $this->connect();
        $statement = $conn->prepare($query);
        $check = $statement->execute($data);
        if ($check) {
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            if (count($result)) return $result;
        }
        return false;
    }

    public function get_row($query, $data = []) {
        $conn = $this->connect();
        $statement = $conn->prepare($query);
        $check = $statement->execute($data);
        if ($check) $result = $statement->fetchAll(PDO::FETCH_OBJ);
        if (count($result)) return $result[0];
        return false;
    }

    
}

