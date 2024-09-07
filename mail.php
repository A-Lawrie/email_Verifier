<?php
$email = $_POST["mail"];

//Step 1: Validate format - Looks for @ sign and domain therefore name@scbkdjkd.djkj is still considered valid
if (filter_var($email, FILTER_VALIDATE_EMAIL) === false){
    exit("This email address ($email) is invalid.");
} else {
    $api_key = "87297e272ed649e19a419db306f5b8fc";

    // Initializing cURL.
    $ch = curl_init();

    curl_setopt_array($ch, [
        CURLOPT_URL => "https://emailvalidation.abstractapi.com/v1?api_key=$api_key&email-$email",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);

    if($data['deliverability'] === "UNDELIVERABLE"){
        exit("undeliverable");
    }
    if($data["is_diaposable_email"]["value"] === true){
        exit("Disposable")
    }
    echo "This email address ($email) is valid.";
}

?>