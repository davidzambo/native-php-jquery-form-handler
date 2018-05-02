<?php

require_once('./models/Model.php');
$response_code = 200;

try {
    $db = new Model();
    $response['data'] = $db->show();
} catch (Exception $e) {
    $response_code = 400;
    $response['error'] = $e->getMessage();
}

header('Content-Type: application/json');
http_response_code($response_code);
echo json_encode($response);