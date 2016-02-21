<?php
class Model{
    protected $dbconn ;

    protected function openDB(){
            try{
                  $MySql_username 	= "root"; //mysql username
                  $MySql_password 	= ""; //mysql password
                  $MySql_hostname 	= "localhost"; //hostname
                  $MySql_databasename     = "webmasr"; //databasename
                  $this->dbconn = new mysqli($MySql_hostname, $MySql_username, $MySql_password, $MySql_databasename)or die("Unable to connect to MySQL");
            }catch(Exception $e){
			return $e->getMessage();
		}
            
    }
    protected function closeDB(){
        mysqli_close($this->dbconn);
    }
}
?>