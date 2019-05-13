<?php
class EP_Database {

    private function __construct(){}
    private function __clone(){}

    private static $db;

    static public $instance;    // The database itself.
    static public function _construct(){
        if(!self::$instance){
            self::$instance = new self();
            self::$db = new PDO('mysql:host=' . DB_HOST .';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
        }

        return self::$instance;
    }

    // Insert data into table
    public function insert($table, $data){
        $sql = "INSERT INTO `$table` (";
        
        foreach($data as $field => $value){
            $sql .= "`$field`";

            end($data);     // Move the pointer to the last index.
            if($field !== key($data)){
                $sql .= ', ';
            }
        }

        $sql .= ') VALUES (';

        foreach($data as $field => $value){
            $sql .= '?';

            end($data);     // Move the pointer to the last index.
            if($field !== key($data)){
                $sql .= ', ';
            }
        }

        $sql .= ');';

        $stmt = self::$db->prepare($sql);
        return $stmt->execute(array_values($data));
    }

    // Execute the single SQL
    public function query($sql, $data = []){
        if(empty($data)){
            $stmt = self::$db->query($sql);
        }else{
            $stmt = self::$db->prepare($sql);
            $stmt->execute(array_values($data));
        }

        return $stmt->fetchAll();
    }

    // Select
//    public function select($table, $field = []){
//        if($field)
//    }

    public function update($table, $data, $condition = []){
        // No condition, turn error.
        if(empty($condition)){
            return false;
        }

        $sql = "UPDATE ? SET ";

        foreach($data as $field => $value){
            $sql .= "`$field` = ?";

            end($data);     // Move the pointer to the last index.
            if($field !== key($data)){
                $sql .= ', ';
            }
        }

        $sql .= ' WHERE ';

        foreach($condition as $field => $value){
            $sql .= "`$field` = ?";

            end($condition);     // Move the pointer to the last index.
            if($field !== key($condition)){
                $sql .= ', ';
            }
        }

        $stmt = self::$db->prepare($sql);
        return $stmt->execute(array_merge([$table], array_values($data), array_values($condition)));
    }

    public function delete($table, $condition = []){
        // TODO
        //$sql = "DELETE FROM ? ";
    }

    public function isRepeat($table, $filed, $value){
        // Check the parameter
        if(is_array($value) && is_array($filed) && (count($filed) == count($value))){
            $sql = "SELECT * FROM `$table` WHERE ";

            $condition = [];
            foreach($filed as $index => $f){
                array_push($condition,"`$f` = ?");
            }

            $sql .= implode(' OR ', $condition);
            $stmt = self::$db->prepare($sql);
            $stmt->execute($value);
            $res = $stmt->fetchAll();
            return !empty($res);

        }else if(is_string($value) && is_string($filed)){
            $sql = "SELECT * FROM `$table` WHERE `$filed` = ?";
            $stmt = self::$db->prepare($sql);
            $stmt->execute([$value]);
            $res = $stmt->fetchAll();
            return !empty($res);
        }else{
             throw new ParameterError(['$value', '$field']);
        }
    }


}