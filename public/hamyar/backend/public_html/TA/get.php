<?php
require __DIR__.'/../../sensetive_info/connection.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
$data = json_decode(file_get_contents('php://input'));
$TA = new TA($db, $data->email);

if(!$TA->get()){
    $response = new response('خطای دریافت اطلاعات', 'تدریسیاری با ایمیل وارد شده وجور ندارد.');
    $response->send(0);
}
$response = new response();
$response->send(1, $TA);
