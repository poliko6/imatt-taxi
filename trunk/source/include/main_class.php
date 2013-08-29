<?php 

	  class Database {
		  
     private $s_server = "imattioapp.com";
	 private $db_username = "taxi";
	 private $db_password = "taxi2013";
	 private $db_name ="taxi_db2";
	 private $sql;
	 private $field;
	 private $table;
	 private $pointsql;
		  
		  public function __construct()
		 {
			mysql_connect($this->s_server,$this->db_username,$this->db_password) or die ("ไม่สามารถเชื่อมต่อฐานข้อมูลได้");
			mysql_select_db($this->db_name) or die ("ไม่สามารถเชื่อมต่อฐานข้อมูลได้sssss");
			mysql_query("SET NAMES utf8;");
		   if(mysql_errno() > 0)  die (mysql_error());
		 }
	
		 public function selectdatasql($field,$table,$pointsql)
		 	{
				$this->field = $field;
				$this->table = $table;
				$this->pointsql = $pointsql;
			
				
				if ($this->pointsql != "")
				{
				
			 		$this->sql = "SELECT"." "."$this->field"." " ."FROM"." "."$this->table "." "."WHERE"." ". "$this->pointsql" ;
				}
				else
				{
					$this->sql = "SELECT"." "."$this->field"." " ."FROM"." "."$this->table" ;
					
				}
		
				
			
				 return mysql_query($this->sql);
			 }
		 
		 
		 
			 
		  		public function mysqlfetcharray($datafetch)
		  		{
					
				  return mysql_fetch_array($datafetch);
			  
			  }
			 
			 
			 public function insertdatasql($field,$table,$pointsql)
		 	{
				$this->field = $field;
				$this->table = $table;
				$this->pointsql = $pointsql;
			 
			 	$this->sql = "INSERT INTO"." "."$this->table"." ". 
							 "("."$this->field".")".
							 " "."VALUES"." "."("."$this->pointsql".")";
			 	 if(mysql_errno() > 0)  die (mysql_error());
				 echo $this->sql;
				
			 	 return mysql_query($this->sql);
			 
			 
			 } 
		 
		 
	 		public function updatedatasql($table,$field,$pointsql)
			{
				$this->field = $field;
				$this->table = $table;
				$this->pointsql = $pointsql;
				
				
				$this->sql = "UPDATE"." "."$this->table"." "."SET".
				" "."$this->field"." ".
				"WHERE"." "."$this->pointsql";
				
				//echo $this->sql;
				return mysql_query($this->sql);
				}
	 
	 		public function deletesql($table,$pointsql)
			{
				$this->field = $field;
				$this->table = $table;
				$this->pointsql = $pointsql;
				
				$this->sql = "DELETE FROM"." ".
				"$this->table". " " ."WHERE". " "."$this->pointsql";
				
				return mysql_query($this->sql);
			}
			
			
			public function mysqlnumrow($datanumrow)
			{
				return mysql_num_rows($datanumrow);	
			}
			
			
			
	 
	 public function dbclose(){
	
		return mysql_close();
		 
	 }
	 
	 
	 
	 
	 }
?>

<img src="../../../../include/class.mysqldb.php"