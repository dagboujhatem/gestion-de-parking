<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
require_once './vendor/autoload.php';
require_once './Firebase/User.php';

use firebase\models\User;
use Kreait\Firebase\Factory;

$conn= new mysqli('localhost','root','','tpts_db')or die("Could not connect to mysql".mysqli_error($con));

/**
 * create firebase config
 */

$firebase = (new Factory)->withServiceAccount(__DIR__ . './secret/parking-81cb5-firebase-adminsdk-rnt56-1916e91393.json')
    ->withDatabaseUri('https://parking-81cb5-default-rtdb.europe-west1.firebasedatabase.app');

// select all users from sql database
$userQuery = $conn->query("SELECT * FROM users");
while($row= $userQuery->fetch_assoc()):
    // create firebase user
    $firebaseUser = new User($firebase);
    //// Adding the data to the database
    $firebaseUser->insert([$row['id'] => $row]);
endwhile;


//var_dump($user->get(1)); // pull the data from the database

//var_dump($user->delete(3)); // deleting data from the database
//die();