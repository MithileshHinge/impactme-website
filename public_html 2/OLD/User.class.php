<?php
/*
 * User Class
 * This class is used for database related (connect, insert, and update) operations
 * @author    CodexWorld.com
 * @url        http://www.codexworld.com
 * @license    http://www.codexworld.com/license
 */

class User {
    private $dbHost     = MYSQL_DB_SERVER;
    private $dbUsername = MYSQL_DB_USER;
    private $dbPassword = MYSQL_DB_PWD;
    private $dbName     = MYSQL_DB_NAME;
    private $userTbl    = 'impact_users';
	
	function __construct(){
		if(!isset($this->db)){
            // Connect to the database
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
            if($conn->connect_error){
                die("Failed to connect with MySQL: " . $conn->connect_error);
            }else{
                $this->db = $conn;
            }
        }
	}
	
	function checkUser($userData = array()){
		if(!empty($userData)){
			// Check whether user data already exists in database
			$prevQuery = "SELECT * FROM ".$this->userTbl." WHERE oauth_provider = '".$userData['oauth_provider']."' AND oauth_uid = '".$userData['oauth_uid']."'";
			$prevResult = $this->db->query($prevQuery);
			if($prevResult->num_rows > 0){
				// Update user data if already exists
				$query = "UPDATE ".$this->userTbl." SET fname = '".$userData['first_name']."', lname = '".$userData['last_name']."', email = '".$userData['email']."', gender = '".$userData['gender']."', fbimage = '".$userData['picture']."', link = '".$userData['link']."', llogin = NOW() WHERE oauth_provider = '".$userData['oauth_provider']."' AND oauth_uid = '".$userData['oauth_uid']."'";
				$update = $this->db->query($query);
			}else{
				// Insert user data
				$query = "INSERT INTO ".$this->userTbl." SET oauth_provider = '".$userData['oauth_provider']."', oauth_uid = '".$userData['oauth_uid']."', fname = '".$userData['first_name']."', lname = '".$userData['last_name']."',verifyemail='y',user_type='fb', email = '".$userData['email']."', gender = '".$userData['gender']."', fbimage = '".$userData['picture']."', link = '".$userData['link']."', rdate = NOW(), llogin = NOW()";
				$insert = $this->db->query($query);
			}
			
			// Get user data from the database
			$result = $this->db->query($prevQuery);
			$userData = $result->fetch_assoc();
		}
		
		// Return user data
		return $userData;
	}
}