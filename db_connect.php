<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
require_once './vendor/autoload.php';
require_once './Firebase/firebaseSync.php';
/**
 *  Create an SQL connection
 */

$conn= new mysqli('localhost','root','','tpts_db')or die("Could not connect to mysql".mysqli_error($con));

/**
 *  Begin sync of all tables
 */

// select all users from sql database
$userQuery = $conn->query("SELECT * FROM users");
firebaseSync($userQuery, 'users');

// select all pricing from sql database
$pricingQuery = $conn->query("SELECT * FROM pricing");
firebaseSync($pricingQuery, 'pricing');

// select all rides from sql database
$ridesQuery = $conn->query("SELECT * FROM rides");
firebaseSync($ridesQuery, 'rides');

// select all system_settings from sql database
$systemSettingsQuery = $conn->query("SELECT * FROM system_settings");
firebaseSync($systemSettingsQuery, 'system_settings');

// select all ticket_items from sql database
$ticketItemsQuery = $conn->query("SELECT * FROM ticket_items");
firebaseSync($ticketItemsQuery, 'ticket_items');

// select all ticket_list from sql database
$ticketListQuery = $conn->query("SELECT * FROM ticket_list");
firebaseSync($ticketListQuery, 'ticket_list');
