<?php 
	
	include("../../../include/class.mysqldb.php");
	
	include("../../../include/config.inc.php");
	  class Database {
	  
	  
	 
	 
		 public function __construct()
		 {
			
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
		
				echo $this->sql;
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