<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$config = require "../config.php";

require_once __DIR__ . '/vendor/autoload.php';

$database = new Connection($config);

$dbh = $database->getConnect();

$policy = new Policy($dbh);
