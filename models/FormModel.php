<?php
    include("Model.php");

    class Form extends Model {
        private $id;
        private $name;
        private $email;
        private $phoneNumber;
        private $birthDate;
        private $licence;
        private $hobby;

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getName(){
            return $this->name;
        }

        public function setName($name){
            $this->name = $name;
        }

        public function getEmail(){
            return $this->email;
        }

        public function setEmail($email){
            $this->email = $email;
        }

        public function getPhoneNumber(){
            return $this->phoneNumber;
        }

        public function setPhoneNumber($number){
            $this->phoneNumber = $number;
        }

        public function getBirthDate(){
            return $this->birthDate;
        }

        public function setBirthDate($birthDate){
            $this->birthDate = $birthDate;
        }

        public function getLicence(){
            return $this->licence;
        }

        public function setLicence($licence){
            $this->licence = $licence == "igen" ? true : false;
        }

        public function getHobby(){
            return $this->hobby;
        }

        public function setHobby($hobby){
            $this->hobby = implode(',', $hobby);
        }

        public function save(){
            $sql = "INSERT INTO interests(name, email, phonenumber, birthdate, licence, hobby) VALUES(:name, :email, :phonenumber, :birthdate, :licence, :hobby)";

            $statement = $this->db->prepare($sql);
            $statement->bindValue(':name', $this->name, PDO::PARAM_STR);
            $statement->bindValue(':email', $this->email, PDO::PARAM_STR);
            $statement->bindValue(':phonenumber', $this->phoneNumber, PDO::PARAM_STR);
            $statement->bindValue(':birthdate', $this->birthDate, PDO::PARAM_STR);
            $statement->bindValue(':licence', $this->licence, PDO::PARAM_BOOL);
            $statement->bindValue(':hobby', $this->hobby, PDO::PARAM_STR);

            try {
                $statement->execute();
            } catch (PDOException $ex){
                throw new Exception("HIBA! Nem sikerült az adatokat menteni!" . $ex->getMessage());
            }
        }

        public function update(){
            $sql = "UPDATE interests SET name = :name, email = :email, phonenumber = :phonenumber, birthdate = :birthdate, 
                    licence = :licence, hobby = :hobby WHERE id = :id";

            $statement = $this->db->prepare($sql);
            $statement->bindValue(':name', $this->name, PDO::PARAM_STR);
            $statement->bindValue(':email', $this->email, PDO::PARAM_STR);
            $statement->bindValue(':phonenumber', $this->phoneNumber, PDO::PARAM_STR);
            $statement->bindValue(':birthdate', $this->birthDate, PDO::PARAM_STR);
            $statement->bindValue(':licence', $this->licence, PDO::PARAM_BOOL);
            $statement->bindValue(':hobby', $this->hobby, PDO::PARAM_STR);
            $statement->bindValue(':id', $this->id, PDO::PARAM_INT);

            try {
                $statement->execute();
            } catch (PDOException $ex){
                throw new Exception("HIBA! Nem sikerült az adatokat frissíteni!" . $ex->getMessage());
            }
        }
    }