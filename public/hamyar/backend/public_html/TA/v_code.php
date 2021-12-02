<?php
require __DIR__.'/../../sensetive_info/connection.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Methods: POST");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Access-Control-Allow-Origin");
use PHPMailer\PHPMailer\PHPMailer;
use phpmailer\PHPMailer\Exception;
$data = json_decode(file_get_contents('php://input'));

$mail = new PHPMailer(true);
$to = filter_var($data->email, FILTER_SANITIZE_EMAIL);
$code = "";
for($i=0; $i<4; $i++)
    $code .= strval(rand(0, 9));
try{
    $mail->isSMTP(); 
    $mail->Host = 'smtp.gmail.com'; 
    $mail->SMTPAuth = true; 
    $mail->Username = 'hamyarapp.fm@gmail.com';
    $mail->Password = '12345FM78';
    $mail->SMTPSecure = true;
    $mail->SMTPAutoTLS = true;
    $mail->SMTPAuth = true;
    $mail->Port = 587;
    $mail->setFrom($to, 'hamyar');
    $mail->addAddress($to, $to);
    $mail->isHTML(true);
    $mail->Subject = "کد عبور";
    $mail->Body ="<p>$code</p>";
    $mail->AltBody = 'Alternate html';
    $mail->CharSet = "UTF-8";
    $mail->send();
    $response = new response("code", $code);
    $response->send(1);
}catch(Exception $e){
    $response = new response("send email failed","Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
    $response->send(0);
}

