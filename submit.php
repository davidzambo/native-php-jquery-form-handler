<?php

require_once('./models/FormModel.php');
require_once('./libs/Validator.php');

$response = array();
$response_code = 201;


// create or update?
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $birthDate = $_POST['birthDate'];
    $phoneNumber = $_POST['phoneNumber'];
    $licence = $_POST['licence'];
    $hobby = $_POST['hobby'];
} elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    parse_str(file_get_contents("php://input"),$_PUT);
    $name = $_PUT['name'];
    $email = $_PUT['email'];
    $birthDate = $_PUT['birthDate'];
    $phoneNumber = $_PUT['phoneNumber'];
    $licence = $_PUT['licence'];
    $hobby = $_PUT['hobby'];
    $id = $_PUT['id'];
}


// Check data validation
if (!Validator::isName($name)) {
    $response_code = 400;
    $response['error']['name'] = "Hibás név!";
}

if (!Validator::isEmail($email)) {
    $response_code = 400;
    $response['email'] = filter_var($email, FILTER_VALIDATE_EMAIL);
    $response['error']['email'] = "Hibás email cím!";
}

if (!Validator::isPhoneNumber($phoneNumber)) {
    $response_code = 400;
    $response['error']['phoneNumber'] = "Hibás telefonszám!";
}

if (!Validator::isBirthDate($birthDate)) {
    $response_code = 400;
    $response['error']['birthDate'] = "Hibás születésnap!";
}

if (!Validator::isHobby($hobby)) {
    $response_code = 400;
    $response['error']['hobby'] = "Hibás hobby";
}

if (!isset($licence)){
    $response_code = 400;
    $response['error']['hobby'] = "Hibás jogosítvány";
}



if ($response_code != 400) {
    try {
        $form = new Form();
        $form->setName($name);
        $form->setEmail($email);
        $form->setPhoneNumber($phoneNumber);
        $form->setBirthDate($birthDate);
        $form->setLicence($licence);
        $form->setHobby($hobby);
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $form->save();
            $response["message"] = "Az adatokat elmentettük!";
        } elseif ($_SERVER['REQUEST_METHOD'] == 'PUT'){
            $form->setId($id);
            $form->update();
            $response["message"] = "Az adatokat frissítettük!";
        }
    } catch (Exception $e) {
        $response_code = 400;
        $response['error']['db'] = $e->getMessage();
    }

} else {
    $response["message"] = "Az adatokat nem mentettük el!";
}


// send response

header('Content-Type: application/json');
http_response_code($response_code);
echo json_encode($response);
