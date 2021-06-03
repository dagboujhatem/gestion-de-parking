<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
require_once './vendor/autoload.php';
include './Firebase/User.php';

$conn= new mysqli('localhost','root','','tpts_db')or die("Could not connect to mysql".mysqli_error($con));
