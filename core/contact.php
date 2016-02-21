<?php
include_once("model.php");
class Contact extends Model{
    
    public function addUserContact($usrData){
            try{
                  $this->openDB();
              
                  $stmt = $this->dbconn->prepare("INSERT INTO contacts (fstname,lstname,email,password,address,image) VALUES (?, ?,?,?,?,?)");
                  $stmt->bind_param('ssssss', $usrData['firstname'],$usrData['lastname'],$usrData['email'],md5($usrData['password']),$usrData['address'],$usrData['image']);
                  
                  
                  $result = mysqli_stmt_execute($stmt);
                  $this->closeDB();
                  return $result;
            }catch(Exception $e){
			return $e->getMessage();
		}
        
	}
	
	public function cheakMail($usrmail){
		$this->openDB();
        
        $stmt = $this->dbconn->prepare("SELECT id FROM contacts WHERE email = ?");
        $stmt->bind_param('s', $usrmail);
        
        
		$stmt->execute();

		$result = $stmt->get_result();
		$result = mysqli_fetch_array($result, MYSQLI_NUM);
        $this->closeDB();
		return $result;
	}
}
?>