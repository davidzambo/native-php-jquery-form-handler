<?php
    define("HOST", "localhost");
    define("USER", "zdavid");
    define("PASS", "Zoh@gee8c");
    define("DB", "zdavid");

class Model{
        public $db;

        function __construct(){
            try{
                $this->db = new PDO("mysql:host=".HOST.";dbname=".DB.";charset=utf8mb4", USER, PASS);
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $ex) {
                throw new Exception("HIBA! Nem sikerült kapcsolódni az adatbázishoz!<br/>" . $ex->getMessage());
            }
        }

        public function show($id = null){
            $sql = "SELECT * FROM interests";

            if (isset($id)){
                $sql .= " WHERE id = $id";
            }

            $statement = $this->db->prepare($sql);

            try {
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $ex){
                throw new Exception("HIBA! Nem sikerülte az adatok lekérése! <br/>" . $ex->getMessage());
            }
        }

    }