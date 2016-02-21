<?php
    include_once("core/contact.php");
    $usremail = $_POST['usrmail'];
    $newContact = new Contact();
    $result = $newContact->cheakMail($usremail);
    $result = count($result) > 0 ? "Email Not Available":true; 
    die(json_encode($result));
?>