<?php
require __DIR__.'/../../sensetive_info/connection.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
$data = json_decode(file_get_contents('php://input'));
$TA = new TA($db, $data->email, $data->studentId, $data->name, $data->aboutMe, $data->mobile, $data->password);
$TA->create();
$response = new response();
$response->send(1,$TA);