<?php
class DbHandler
{
	var $error;         
	var $query;         
	var $host;
	var $user;
	var $pass;
	var $db;  
	var $link;
	
	function DbHandler()
	{
		$this->host = DB_HOST;
		$this->user = DB_USER;
		$this->pass = DB_PASSWORD;
		$this->db = DB_NAME;
		$this->connect();
	}
	
	function connect($host='', $user='', $pass='', $db='', $persistant=false) 
	{
		if (!empty($host)) $this->host = $host; 
		if (!empty($user)) $this->user = $user; 
		if (!empty($pass)) $this->pass = $pass; 
		if ($persistant) 
			$this->link = mysql_pconnect($this->host, $this->user, $this->pass);
		else 
			$this->link = mysql_connect($this->host, $this->user, $this->pass);
		if (!$this->link) 
		{
			$this->error = mysql_error();
			return false;
		} 
		// Select the database
		if (!$this->dbSelect($db)) return false;
		return true;  // success
	}
	
	function dbSelect($db='')
	{
		if (!empty($db)) $this->db = $db; 
		if (!mysql_select_db($this->db)) 
		{
			$this->error = mysql_error();
			return false;
		}
		return true;
	}
	
	function selectData($sql) 
	{
		$this->query = $sql;
		$result = mysql_query($this->query);
		if(!is_resource($result))
		{
			$this->error = mysql_error();
			return false;
		}
		return $result;
	}
 
	function getRow($result) 
	{
		// returns a row
		@$row = mysql_fetch_array($result); 
		if (!$row) return false;
		foreach ($row as $key => $value) 
		{
			$row[$key] = $value;
		}
		return $row;
	}
   
	function insertSql($sql) 
	{
		//echo  $sql;
		$this->query = $sql;
		$result = mysql_query($sql);
		if (!$result) 
		{
			$this->error = mysql_error();
			return false;
		}
		$id = mysql_insert_id();
		if ($id == 0) return true;
		else return $id; 
	}
	
	function updateSql($sql) 
	{
	//	echo $sql;
		$this->query = $sql;
		$result = mysql_query($sql);
		if (!$result) 
		{
			$this->error = mysql_error();
			return false;
		}
		$rows = mysql_affected_rows();
		if ($rows == 0) return true; 
		else return $rows;
	}
	
	function selectSql($sql) 
	{
	//	echo $sql;
		$this->query = $sql;
		$result = mysql_query($sql);
		if (!$result) 
		{
			$this->error = mysql_error();
			return false;
		}
		//$rows = mysql_fetch_array($result);
		//if ($rows == 0) return true; 
		//else return $rows;
		return $result;
	}

	function getField($table)
	{
		$field_list = array();
		$fields = mysql_list_fields($this->db, $table);
		$columns = mysql_num_fields($fields);
		
		for ($i = 0; $i < $columns; $i++) {
			$field_list[$i] =  mysql_field_name($fields, $i) . "\n";
		}
		return $field_list;
	}	
	
	function getFormValue($table, $request)
	{
		$field_list = $this->getField($table);
		
		foreach($request as $key => $value)
		{
			foreach($field_list as $field => $name)
			{
				//echo "<br>".$key." ". $name;
				if(strtolower(trim($key))==strtolower(trim($name)))
				{
					//echo "........found ";
					$data[$key] = $value;
					break;
				}
			}
		}
		return $data;
	}
   
    function selectDataArray($table, $request, $condition) 
	{
		$data = $this->getFormValue($table, $request);
		// Updates a row into the database from key->value pairs in an array. 
		// Returns the number of row affected or true if no rows needed the update.
		// Returns false if there is an error.
		$sql = "select * from $table ";
		/*foreach ($data as $key=>$value) 
		{    
			$value = mysql_real_escape_string($value);
			$sql .= " $key=";  
			$sql .= "'$value',";
		}
		$sql = rtrim($sql, ','); */
		if (!empty($condition)) $sql .= " WHERE $condition ";
		// update values
		return  $sql;
	}

	function insertDataArray($table, $request) 
	{
		$data = $this->getFormValue($table, $request);
		// Inserts a row into the database from key->value pairs in an array.
		// Returns the id of the insert or true if there is not auto_increment
		// column in the table.  Returns false if there is an error.
		$cols = '(';
		$values = '(';
		foreach ($data as $key=>$value) 
		{     
			$value = mysql_real_escape_string($value);
			$cols .= "$key,";  
			$values .= "'$value',";  
		}
		$cols = rtrim($cols, ',').')';
		$values = rtrim($values, ',').')';     
		// insert values
		$sql = "INSERT INTO $table $cols VALUES $values";
		//echo $sql;
		return $this->insertSql($sql);
	}
   
    function get_field_name($table, $request) 
	{
		$data = $this->getFormValue($table, $request);
		// Inserts a row into the database from key->value pairs in an array.
		// Returns the id of the insert or true if there is not auto_increment
		// column in the table.  Returns false if there is an error.
		//$cols = '(';
		$values = '(';
		foreach ($data as $key=>$value) 
		{     
			$value = mysql_real_escape_string($value);
			$cols .= "$key,";  
			$values .= "'$value',";  
		}
		return $cols ;
		 
	}
	 
	function updateArray($table, $request, $condition) 
	{
		$data = $this->getFormValue($table, $request);
		// Updates a row into the database from key->value pairs in an array. 
		// Returns the number of row affected or true if no rows needed the update.
		// Returns false if there is an error.
		$sql = "UPDATE $table SET";
		foreach ($data as $key=>$value) 
		{    
			$value = mysql_real_escape_string($value);
			$sql .= " $key=";  
			$sql .= "'$value',";
		}
		$sql = rtrim($sql, ','); 
		if (!empty($condition)) $sql .= " WHERE $condition";
		// update values
		return $this->updateSql($sql);
	}
	
	function deleteData($table, $condition) 
	{
		$sql = "Delete from $table ";
		
		if (!empty($condition)) $sql .= " WHERE $condition";
		return $this->updateSql($sql);
	}
	
	function countRows($sql)
	{
	  $this->query=$sql;
	  $result= mysql_query($this->query);
      $num_rows = @mysql_num_rows($result);
	  return $num_rows ;
	}
	

} 
?>