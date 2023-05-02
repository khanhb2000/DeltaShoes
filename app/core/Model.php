<?php

Trait Model {
    use Database;
    
    public function select($data = []) {
        $query = "select * from $this->table";
        if (count($data)) {
            $query .= " where ";
            $keys = array_keys($data);
            foreach ($keys as $key) {
                $query .= $key ." = :". $key . " && ";
            }

            $query = trim($query, " && ");
        }
        return $this->query($query, $data);
    }

    public function insert($data) {
        $keys = array_keys($data);
        $query = "insert into $this->table (".implode(",", $keys).") values (:".implode(",:", $keys).")";
        return $this->query($query, $data);
    }
}