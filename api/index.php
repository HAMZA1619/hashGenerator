<?php
header('Content-Type: application/json');

// Define the PHP function
function myFunction($data,$app_secret) {
    // Perform some logic with $param

        // Prepare the data string

        $iv = substr(sha1(mt_rand()), 0, 16);
    
        // Hash the app secret to create a password
        $password = sha1($app_secret);
    
        // Generate a salt
        $salt = substr(sha1(mt_rand()), 0, 4);
        // Combine password and salt, then hash with SHA256
        $saltWithPassword = hash('sha256', $password . $salt);
     
        // Encrypt the data using AES-256-CBC
        $encrypted = openssl_encrypt($data, 'aes-256-cbc', $saltWithPassword, 0, $iv);
    
        // Create the final encrypted message bundle
        $msg_encrypted_bundle = "$iv:$salt:$encrypted";
    
        // Replace '/' with '__' to make it URL safe
        $msg_encrypted_bundle = str_replace('/', '__', $msg_encrypted_bundle);
    
        return $msg_encrypted_bundle;
}

// Retrieve and sanitize the parameter from the request
$data = isset($_GET['data']) ? $_GET['data'] : '';
$app_secret = isset($_GET['app_secret']) ? $_GET['app_secret'] : '';


// Call the function and return the result
echo json_encode(myFunction($data,$app_secret));
?>
