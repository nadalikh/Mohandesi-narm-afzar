<?php

#import jwt lib
// require __DIR__."/../vendor/firebase/php-jwt/src/BeforeValidException.php";
// require __DIR__."/../vendor/firebase/php-jwt/src/ExpiredException.php";
// require __DIR__."/../vendor/firebase/php-jwt/src/JWK.php";
// require __DIR__."/../vendor/firebase/php-jwt/src/JWT.php";
// require __DIR__."/../vendor/firebase/php-jwt/src/SignatureInvalidException.php";

require __DIR__."/../public_html/classes.php";
require __DIR__."/../vendor/autoload.php";


define('TOKEN_KEY','HAMYAR');
$db = new mysqli('localhost', 'frb194925_shop', 'Nadali_12345678', 'frb194925_shop');
if($db->connect_error){
    $error = new response('خطای اتصال به دیتابیس','در اتصال به دیتابیس خطا وجود دارد');
    $error->send(0);
}
$db->query("SET NAMES 'utf8'");
$db->set_charset('utf8');

