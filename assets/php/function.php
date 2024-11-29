<?php
require_once 'config.php';
$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("database is not connected");

// Function to show pages 
function showPage($page, $data = "")
{
    $safePage = basename($page); // Prevent directory traversal
    include("./assets/pages/$safePage.php");
}

// Function to show error 
function showError($field)
{
    if (isset($_SESSION['error'])) {
        $error = $_SESSION['error'];
        if (isset($error['field']) && $field == $error['field']) {
            ?>
            <div class="alert alert-danger my-2" role="alert">
                <?= $error['msg'] ?>
            </div>
            <?php
        }
    }
}

// Function to show previous form data 
function showFormData($field)
{
    if (isset($_SESSION['formdata'])) {
        $formdata = $_SESSION['formdata'];
        return $formdata[$field] ?? null;
    }
}

// for checking dublicate email 
function isEmailRegistered($email)
{
    global $db;
    $query = "SELECT count(*) as row FROM users WHERE email='$email'";
    $run = mysqli_query($db, $query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row'];
}


//for checking dublicate username
function isUsernameRegistered($username)
{
    global $db;
    $query = "SELECT count(*) as row FROM users WHERE username='$username'";
    $run = mysqli_query($db, $query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row'];
}

// Validating signup form
function validateSignupForm($form_data)
{
    $response = array('status' => true, 'msg' => '');

    if (!isset($form_data['password']) || !$form_data['password']) {
        $response['msg'] = "Password is not provided";
        $response['status'] = false;
        $response['field'] = 'password';
    } else if (strlen($form_data['password']) < 8) {
        $response['msg'] = "Password must be at least 8 characters long";
        $response['status'] = false;
        $response['field'] = 'password';
    } else if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $form_data['password'])) {
        $response['msg'] = "Password must include at least one special character (!@#$%^&*(),.?\":{}|<>)";
        $response['status'] = false;
        $response['field'] = 'password';
    }

    if (!isset($form_data['username']) || !$form_data['username']) {
        $response['msg'] = "Username is not provided";
        $response['status'] = false;
        $response['field'] = 'username';
    }

    if (!isset($form_data['email']) || !$form_data['email']) {
        $response['msg'] = "Email is not provided";
        $response['status'] = false;
        $response['field'] = 'email';
    }

    if (!isset($form_data['last_name']) || !$form_data['last_name']) {
        $response['msg'] = "Last name is not provided";
        $response['status'] = false;
        $response['field'] = 'last_name';
    }

    if (!isset($form_data['first_name']) || !$form_data['first_name']) {
        $response['msg'] = "First name is not provided";
        $response['status'] = false;
        $response['field'] = 'first_name';
    }

    if (isEmailRegistered($form_data['email'])) {
        $response['msg'] = "Email is already registered";
        $response['status'] = false;
        $response['field'] = 'email';
    }

    if (isUsernameRegistered($form_data['username'])) {
        $response['msg'] = "Username is already registered";
        $response['status'] = false;
        $response['field'] = 'username';
    }


    return $response;
}


// validationg login in php
function validateLoginForm($form_data)
{
    $response = array();
    $response['status'] = true;
    $blank=false;


    if(!$form_data['password']){
        $response['msg'] = "Password is not provided";
        $response['status'] = false;
        $response['field'] = 'password';
        $blank=true;
    }
    if(!$form_data['username_email']){
        $response['msg'] = "Username/email is not provided";
        $response['status'] = false;
        $response['field'] = 'username_email';
        $blank=true;
    }
    if(!$blank && !checkUser($form_data)['status']){
        $response['msg'] = "Something is incrcoet we cannot find you";
        $response['status'] = false;
        $response['field'] = 'checkuser';
    }else{
        $response['user']=checkUser($form_data)['user'];
    }
   return $response;
}

// for checking user 
function checkUser($login_data)
{
    global $db;
    $username_email = $login_data['username_email'];
    $password = md5($login_data['password']);
    $query = "SELECT * FROM users WHERE (email='$username_email' || username ='$username_email') && password = '$password'";
    $run = mysqli_query($db, $query);
    $data['user'] = mysqli_fetch_assoc($run) ?? array();
    if (count($data['user']) > 0) {
        $data['status'] = true; 
    } else {
        $data['satus'] = false;
    }
    return $data;
}

//for geeting userr data by id
function getUser($user_id)
{
    global $db;
    
    $query = "SELECT * FROM users WHERE id=$user_id ";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_assoc($run);
    
 
}

// for creating a new user 
function createUser($data)
{
    global $db;
    $first_name = mysqli_real_escape_string($db, $data['first_name']);
    $last_name = mysqli_real_escape_string($db, $data['last_name']);
    $gender = $data['gender'];
    $email = mysqli_real_escape_string($db, $data['email']);
    $username = mysqli_real_escape_string($db, $data['username']);
    $password = mysqli_real_escape_string($db, $data['password']);
    $password = md5($password);
    $query = "INSERT INTO users(first_name,last_name,gender,email,username,password)";
    $query .= "VALUES ('$first_name','$last_name',$gender,'$email','$username','$password')";
    return mysqli_query($db, $query);
}

?>
