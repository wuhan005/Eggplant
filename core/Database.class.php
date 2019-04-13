<?php
class EP_Database {

    private function __construct(){}
    private function __clone(){}

    private static $db;

    static public $instance;    // The database itself.
    static public function _construct(){
        if(!self::$instance){
            self::$instance = new self();
            try{
                self::$db = new PDO('mysql:host=' . DB_HOST .';dbname=' . DB_NAME, DB_NAME, DB_PASSWORD);
            }catch (Exception $e){
                Corrector::Show(102);
            }
        }

        return self::$instance;
    }

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
        $stmt->execute(array_values($data));

    }

    public function query($sql, $data = []){
        if(empty($data)){
            $stmt = self::$db->query($sql);
        }else{
            $stmt = self::$db->prepare($sql);
            $stmt->execute(array_values($data));
        }

        return $stmt->fetchAll();
    }

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
        $stmt->execute(array_merge([$table], array_values($data), array_values($condition)));

        return true;
    }

    public function delete($table, $condition = []){
        // TODO
        //$sql = "DELETE FROM ? ";
    }


}