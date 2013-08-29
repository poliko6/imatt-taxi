<?php

	//include('include/main_class.php');
	class driver_taxi extends Database
	
	{
		private $sqlquery;
		private $numrowquery;
		private $firstName = array();
		private $lastname = array();
		private $province = array();
		private $mobilePhone = array();
		private $telephone = array();
		private $address = array();
		private $driverImage = array();
	public function __construct()
	 {
		 parent::__construct();
	 }
		
		
		public function show_alldriver()
			{
				
				$query = $this->selectdatasql("*","drivertaxi INNER JOIN province ON drivertaxi.provinceId = province.provinceId INNER JOIN district ON drivertaxi.districtId = district.districtId
				INNER JOIN amphur ON drivertaxi.amphurId = amphur.amphurId","");		
				$i = 1 ;	
				while($row = mysql_fetch_array($query))
				
				{
					$this->driverImage[$i] = $row[driverImage];
					$this->firstName[$i] = $row[firstName];
					$this->lastname[$i] = $row[lastName];
					$this->licenseNumber[$i] = $row[licenseNumber];
					$this->mobilePhone[$i] = $row[mobilePhone];
					$this->telephone[$i] = $row[telephone];
					$this->address[$i] = $row[address]." ".$row[districtName]." ".$row[amphurName]." ".$row[provinceName]." ".$row[zipcode];
					
					$i++;
				}
				
				$this->numrowquery = $this->mysqlnumrow($query);
				
				
			}
			
			
		public function get_firstName($i)
			{
				return  $this->firstName[$i];
			}
		public function get_lastname($i)
			{
				return  $this->lastname[$i];
			}
		public function get_licenseNumber($i)
			{
				return  $this->licenseNumber[$i];
			}
		public function get_mobilePhone($i)
			{
				return  $this->mobilePhone[$i];
			}
		public function get_telephone($i)
			{
				return  $this->telephone[$i];
			}
		public function get_address($i)
			{
				return  $this->address[$i];
			}
		public function get_driverImage($i)
			{
				return  $this->driverImage[$i];
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