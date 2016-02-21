<?php
include_once("core/contact.php");
$slider[] = "assets/images/1.jpg";
$slider[] = "assets/images/2.jpg";
$slider[] = "assets/images/3.jpg";

$notification = "";
if(isset($_POST["submit"])){
    $userContact = $_POST;
    
    $validator = validateUserContacts();
    if($validator === true){
        $newContact = new Contact();
        $result = $newContact->addUserContact($userContact);
        if($result == true){
            $notification =     '<div class="alert alert-success">
                        <strong>Success!</strong> Contact Added Successfully.
                    </div>';
        }else{
            $notification =    '<div class="alert alert-danger">
                        <strong>Error!</strong> '.$result.
                    '</div>';
        }
    }else{
        $notification = "";
        foreach($validator as $key => $value){
            $notification .=    '<div class="alert alert-danger">
                        <strong>' . $value . '!</strong>
                        </div>';
        }
    }
}

function validateUserContacts(){
    
    
    global $userContact ;
    $userImage = $_FILES;
    $errorMessege = array();
    if(empty($userContact["firstname"])){
        $errorMessege[] = "First Name is required";
    }else{
        if(!preg_match('/^[a-zA-Z]+[a-zA-Z._]+$/', $userContact["firstname"]))
        {
            $errorMessege[] = "First Name shall not contain Numbers or special characters";
        }
    }
    
    if(empty($userContact["lastname"])){
        $errorMessege[] = "Last Name is required";
    }
    
    if(empty($userContact["email"])){
        $errorMessege[] = "Email is required";
    }else{
        if (!filter_var($userContact["email"], FILTER_VALIDATE_EMAIL)) {
            $errorMessege[] = "Email is not valid";
        }
    }
    if(isset($userContact['g-recaptcha-response'])){
        
        $secret = '6LcyogwTAAAAANlYRXc8mLbTQKEity9jIkNDiCiU';
        
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
        
        if($responseData && !$responseData->success){
            $errorMessege[] = "Robot verification failed, please try again.";
        }
    }
    if(empty($userContact["password"])){
        $errorMessege[] = "Password is required";
    }else{
        if(empty($userContact["confirmpassword"])){
            $errorMessege[] = "Password is Not Confimed";
        }
    }
    
    if($_FILES ["fileToUpload"]["error"] != 0){
        $errorMessege[] = "Image is required";
    }else{
    
        if(empty($errorMessege)){
            $target_dir = "uploads/";
            $target_file = $target_dir . basename(uniqid());
            $uploadOk = 1;
            $imageFileType = pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION);
            
            if ($_FILES["fileToUpload"]["size"] > 500000) {
                $errorMessege[] = "Image is too large";
                $uploadOk = 0;
            }
            
            if($imageFileType != "jpg" && $imageFileType != "jpeg") {
                $errorMessege[] = "Image is not jpg or jpeg";
                $uploadOk = 0;
            }else{
                $target_file .= "." . $imageFileType;
            }
            
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check == false) {
                $errorMessege[] = "Image is not valid";
                $uploadOk = 0;
            }
            
            if (($uploadOk == 1) && move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                
                $userContact['image'] = $target_file;
            }else{
                
                $errorMessege[] = "Error uploading Image";
            }
        }
    }
    
    return !empty($errorMessege) ? $errorMessege : true;
}


?>