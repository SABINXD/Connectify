<?php
require_once 'assets/php/function.php';
if(isset($_SESSION['Auth'])){
    $user = getUser($_SESSION['userdata']['id']);
}

if(isset($_SESSION['Auth']) && $user['ac_status']==1){
    showPage('header', ["page_title" => 'Connectify - Connect  all over the world']);
    showPage('main');
} else if(isset($_SESSION['Auth']) && $user['ac_status']==0){
    showPage('header', ["page_title" => 'verify you email']);
    showPage('verify_email');
}
else if(isset($_SESSION['Auth']) && $user['ac_status']==2){
    showPage('header', ["page_title" => 'Something is Unavailable']);
    showPage('blocked');
}

else if (isset($_GET['signup'])) {
    showPage('header', ["page_title" => 'Connectify - Signup page connectify']);
    showPage('signup');
}else if(isset($_GET['login'])){
    showPage('header', ["page_title" => 'Connectify - login page connectify']);
    showPage('login');
    
}else{
    showPage('header', ["page_title" => 'Connectify - login page connectify']);
    showPage('login'); 
}





showPage('footer');
unset($_SESSION['error']);
unset($_SESSION['formdata']);

?>