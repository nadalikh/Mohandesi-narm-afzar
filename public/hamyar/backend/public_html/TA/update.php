<?php
require __DIR__.'/../../sensetive_info/connection.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
$data = json_decode(file_get_contents('php://input'));

$updateTo = new TA( $db, 
                    (isset($data->email)) ? $data->email : null,
                    (isset($data->studentId)) ? $data->studentId : null,
                    (isset($data->name)) ? $data->name : null,
                    (isset($data->aboutMe)) ? $data->aboutMe : null,
                    (isset($data->mobile)) ? $data->mobile : null,
                    (isset($data->password)) ? $data->password : null
                );
$ta = new TA($db, $data->prevEmail);
if($ta->get()){
    $ta->update($updateTo);
    $response = new response();
    $response->send(1, $ta);
}else{
    $response = new response("آپدیت تدریسیار", 'ایمیل مد نظر یافت نشد.');
    $response->send(0);
}