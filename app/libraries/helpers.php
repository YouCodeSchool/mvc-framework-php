<?php

function response($data, $method, $code){
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: " . $method);
    header("Access-Control-Allow-Headers: Content-Type, Accept, Access-Control-Request-Method, Access-Control-Allow-Origin");
    http_response_code($code);
    echo json_encode($data);
}