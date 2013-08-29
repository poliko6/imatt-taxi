<?php
include("main_class.php");

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
				
				echo $query ;
				$this->numrowquery = mysqlnumrow($datanumrow);
				$i = 0;
				echo $this->numrowquery;
				while($row = $this->mysqlfetcharray($query));
				{
					$this->firstName[$i] = $row[firstName];
					
					$i++;
				}
				
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