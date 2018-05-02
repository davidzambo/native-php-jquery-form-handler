<?php
    class Validator{
        static function isName($name){
            $name_regexp = "/^[\[a-zA-ZáÁéÉíÍóÓöÓőŐúÚüÜűŰ\s]+$/";
            return preg_match($name_regexp,$name) > 0;
        }

        static function isEmail($email){
            return filter_var($email, FILTER_VALIDATE_EMAIL);
        }

        static function isPhoneNumber($number){
            return preg_match("/^\d{11}$/", $number) > 0;
        }

        static function isBirthDate($date){
            return preg_match("/^\d{4}\-\d{2}\-\d{2}\$/", $date) > 0;
        }

        static function isHobby($hobby){
            return sizeof($hobby) > 0;
        }
}
