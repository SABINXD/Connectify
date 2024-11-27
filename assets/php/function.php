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
    $response['status'] = true;

    if (!isset($form_data['password']) || !$form_data['password']) {
        $response['msg'] = "password is not given";
        $response['status'] = false;
        $response['field'] = 'password';
    }

    if (!isset($form_data['username']) || !$form_data['username']) {
        $response['msg'] = "username is not given";
        $response['status'] = false;
        $response['field'] = 'username';
    }

    if (!isset($form_data['email']) || !$form_data['email']) {
        $response['msg'] = "email is not given";
        $response['status'] = false;
        $response['field'] = 'email';
    }

    if (!isset($form_data['last_name']) || !$form_data['last_name']) {
        $response['msg'] = "last name is not given";
        $response['status'] = false;
        $response['field'] = 'last_name';
    }

    if (!isset($form_data['first_name']) || !$form_data['first_name']) {
        $response['msg'] = "first name is not given";
        $response['status'] = false;
        $response['field'] = 'first_name';
    }
    if (isEmailRegistered($form_data['email'])) {
        $response['msg'] = "Email Id is already registered";
        $response['status'] = false;
        $response['field'] = 'email';
    }
    if (isUsernameRegistered($form_data['username'])) {
        $response['msg'] = "Username Id is already registered";
        $response['status'] = false;
        $response['field'] = 'username';
    }

    return $response;
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
    return mysqli_query($db,$query);
}
?>