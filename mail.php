<?php
$email = $_POST["mail"];

if (filter_var($email, FILTER_VALIDATE_EMAIL) === false){
    exit("This email address ($email) is invalid.");
} else {
    echo "This email address ($email) is valid.";
}

?>