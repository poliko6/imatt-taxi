<?php

	//include('include/main_class.php');
	class driver_taxi extends Database
	
	{
		private $sqlquery;
		private $numrowquery;
		private $firstName = array();
		
	public function __construct()
	 {
		 parent::__construct();
	 }
		
		
		public function show_alldriver()
			{
				
				$query = $this->selectdatasql("*","drivertaxi","");		
				$i = 1 ;	
				while($row = mysql_fetch_array($query))
				{
					$this->firstName[$i] = $row[firstName];
					$i++;
				}
				
				$this->numrowquery = $this->mysqlnumrow($query);
				
				
			}
			
			
		public function get_firstName($i)
			{
				return  $this->firstName[$i];
			}
			
		public function get_row()
			{
				return  $this->numrowquery;
			}	
			
		
		public function add_drivetaxi()
			{
				
				
			}
		public function edit_drivetaxi()
		{
			
			
			}
		
		
	}
	
	

?>