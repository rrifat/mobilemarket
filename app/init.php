<?php

$server = 'localhost';
$username = 'root';
$password = '';
$db = 'mobilemarket';

$Database = new mysqli($server,$username,$password,$db);


mysqli_report(MYSQLI_REPORT_ERROR);
ini_set('display_errors', 1);


define('SITE_NAME', 'Online Mobile Store');
define('SITE_PATH', 'http://localhost/ecomshop/');
define('IMAGE_PATH', 'http://localhost/ecomshop/resources/images/');


include('app/models/m_auth.php');
include('app/models/m_template.php');
include('app/models/m_categories.php');
include('app/models/m_products.php');
include('app/models/m_cart.php');


$Auth = new Auth();
$Template = new Template();
$Categories = new Categories();
$Products = new Products();
$Cart = new Cart();

session_start();


?>