<?php
require __DIR__.'/../../sensetive_info/connection.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Methods: POST");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Access-Control-Allow-Origin");

use Firebase\JWT\JWT;
$data = json_decode(file_get_contents('php://input'));
$TA = new TA($db, $data->email);

if(!$TA->get()){
    $response = new response('خطای دریافت اطلاعات', 'تدریسیاری با ایمیل وارد شده وجور ندارد.');
    $response->send(0);
}
if($TA->password == $data->password){
    $myToken = JWT::encode([

        'email'=>$TA->email,
        'name' =>$TA->name,
        'studen_id'=>$TA->studentId

    ], TOKEN_KEY);
    $response = new response();
    $response->send(1, ["token" => $myToken]);
}else{
    $response = new response('خطای لاگ این', 'پسورد وارد شده اشتباه ست');
    $response->send(0);
}