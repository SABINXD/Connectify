<?php
require_once 'assets/php/function.php';



if (isset($_GET['signup'])) {
    showPage('header', ["page_title" => 'Connectify - Signup page connectify']);
    showPage('signup');
}




showPage('footer');
unset($_SESSION['error']);
unset($_SESSION['formdata']);

?>