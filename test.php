<?php
require 'vendor/autoload.php';
echo  $_SERVER['DOCUMENT_ROOT'].'/HWdoc/Home/vendor/autoload.php';
echo __DIR__;
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__); //Notice the Namespace and Class
$dotenv->load();
echo "hi";
// $s3_bucket = $_ENV['DB_USER'];
// $s3_bucket = $_SERVER['S3_BUCKET'];
echo $s3_bucket;
echo "hi";