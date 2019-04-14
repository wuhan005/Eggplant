<?php

// The main entrance.
header('content-type:application/json;charset=utf-8');
// CORS header
header('Access-Control-Allow-Headers: Origin,Content-Length,Content-Type,authorization,content-type,user-agent');
header('Access-Control-Allow-Methods: GET,POST,OPTIONS');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Max-Age: 3600");

define('BASEPATH', dirname(__FILE__));

// Let's begin!!
require_once '../core/Eggplant.php';
new Eggplant();