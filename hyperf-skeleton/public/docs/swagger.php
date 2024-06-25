<?php
$autoload = dirname(dirname(__DIR__)) . '/vendor/autoload.php';
//echo $autoload."\n";
require_once  $autoload;
//


$path = dirname(dirname(__DIR__)) . "/app/Controller/OpportunityController.php";

$openapi = \OpenApi\Generator\scan([$path]);

header('Content-Type: application/json');
echo $openapi->toJson();