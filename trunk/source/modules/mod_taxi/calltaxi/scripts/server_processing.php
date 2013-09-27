<?php
	header('Content-Type: text/html; charset=utf-8');
	
	//$aColumns = array( 'carImage', 'englishCompanyName', 'carRegistration', 'carBannerNameEng', 'carStatusId', 'carId' );
	$aColumns = array(
		'historyId',
		'driverhistory.customerId',
		'firstName',
		'lastName',
		'telephone',
		'callTime',
		'generateCode',
		'statusWork',
		'startLatitude',
		'startLongitude',
		'startPlace'
	);
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "historyId";
	
	/* DB table to use */
   	$sTable = "driverhistory";
 
   	// Joins
	$sJoin = 'JOIN customer ON((customer.customerId = driverhistory.customerId)) ';

	/* Database connection information */
	/*$gaSql['user']       = "taxi";
	$gaSql['password']   = "taxi2013";
	$gaSql['db']         = "taxi_db2";
	$gaSql['server']     = "imattioapp.com";*/
	include("../../../../include/class.function.php");
	include("../../../../include/db_connect.php" );
	
	

	/* 
	 * Local functions
	*/
	function fatal_error ( $sErrorMessage = '' )
	{
		header( $_SERVER['SERVER_PROTOCOL'] .' 500 Internal Server Error' );
		die( $sErrorMessage );
	}

	
	/* 
	 * MySQL connection
	 */
	if ( ! $gaSql['link'] = mysql_pconnect( $gaSql['server'], $gaSql['user'], $gaSql['password']  ) )
	{
		fatal_error( 'Could not open connection to server' );
	}

	if ( ! mysql_select_db( $gaSql['db'], $gaSql['link'] ) )
	{
		fatal_error( 'Could not select database ' );
	}
	//iNanCM.com
	mysql_query("SET NAMES UTF8");

	/* 
	 * Paging
	 */
	$sLimit = "";
	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
	{
		$sLimit = "LIMIT ".intval( $_GET['iDisplayStart'] ).", ".
			intval( $_GET['iDisplayLength'] );
	}
	
	
	/*
	 * Ordering
	 */
	$sOrder = "";
	if ( isset( $_GET['iSortCol_0'] ) )
	{
		$sOrder = "ORDER BY  ";
		for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
		{
			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
			{
				$sOrder .= "".$aColumns[ intval( $_GET['iSortCol_'.$i] ) ]." ".
					($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
			}
		}
		
		$sOrder = substr_replace( $sOrder, "", -2 );
		if ( $sOrder == "ORDER BY" )
		{
			$sOrder = "";
		}
	}
	
	
	/* 
	 * Filtering
	 * NOTE this does not match the built-in DataTables filtering which does it
	 * word by word on any field. It's possible to do here, but concerned about efficiency
	 * on very large tables, and MySQL's regex functionality is very limited
	 */
	
	/*if ($garageId != ''){
		$sWhere = "where mobile.garageId = '".$garageId."'";
	} else {
		$sWhere = "";
	}*/
	$sWhere = "";
	//$sSearch = iconv("tis-620","utf-8",$_GET['sSearch']);
	if ( isset($_GET['sSearch'] ) && $_GET['sSearch']  != "" )
	{
		$sWhere = "WHERE (";
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" )
			{
				$sWhere .= "".$aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
			}
		}
		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere .= ')';
	}
	
	/* Individual column filtering */
	for ( $i=0 ; $i<count($aColumns) ; $i++ )
	{
		if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
		{
			if ( $sWhere == "" )
			{
				$sWhere = "WHERE ";
			}
			else
			{
				$sWhere .= " AND ";
			}
			$sWhere .= "".$aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
		}		
	}
	

	if ( $sWhere == "" )
	{
		$sWhere = "WHERE statusWork != '7' AND statusWork != '5' AND  statusWork != '6' AND  statusWork != '99' AND  statusWork != '88'";
	}
	else
	{
		$sWhere .= " AND statusWork != '7' AND statusWork != '5' AND  statusWork != '6' AND  statusWork != '99' AND  statusWork != '88'";
	}
 
	
	
	/*
	===============================
	อธิบาย ความหมายของ flag 
	===============================
	table likit_cust_select_car
	flag = 1     หมายถึง   ลูกค้าแจ้งเข้ามา ว่าต้องการ รถแท๊กซี่
	flag = ว่าง    หมายถึง   ลูกค้า เมื่อได้รับ หน้าจอ มีรถให้เลือก 10 คัน และลูกค้าตอบ "ไม่เลือกรถใดๆ" //ให้ไปที่ 99
	flag = 2     หมายถึง   ลูกค้า เมื่อได้รับ หน้าจอ มีรถให้เลือก 10 คัน และลูกค้าตอบ "ให้บริษัทเลือกรถให้"
	flag = 3     หมายถึง   call center ส่งรถให้ ลูกค้า
	flag = 4     หมายถึง   ลูกค้า เมื่อได้รับ หน้าจอ มีรถให้เลือก 10 คัน และลูกค้าตอบ "เลือกรถแท๊กซี่ 1 คัน ที่จะให้มารับ" 
	flag = 5     หมายถึง   ลูกค้า ขึ้นรถ
	flag = 6     หมายถึง   ลูกค้า ลงรถ
	flag = 7     หมายถึง   คนขับรับงาน
	flag = 99    หมายถึง   ลูกค้า ยกเลิก
	flag = 88    หมายถึง   แท๊กซี่ ยกเลิก
	*/
	
	/*
	 * SQL queries
	 * Get data to display
	 */
	$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
		FROM   $sTable
		$sJoin
		$sWhere
		$sOrder
		$sLimit
		";
	//echo $sQuery;
	$rResult = mysql_query( $sQuery, $gaSql['link'] ) or fatal_error( 'MySQL Error: ' . mysql_errno() );
	
	/* Data set length after filtering */
	$sQuery = "
		SELECT FOUND_ROWS()
	";
	$rResultFilterTotal = mysql_query( $sQuery, $gaSql['link'] ) or fatal_error( 'MySQL Error: ' . mysql_errno() );
	$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
	$iFilteredTotal = $aResultFilterTotal[0];
	
	/* Total data set length */
	/*  จำนวนทั้งหมด */
	$sQuery = "
		SELECT COUNT(`".$sIndexColumn."`)
		FROM   $sTable
	";
	$rResultTotal = mysql_query( $sQuery, $gaSql['link'] ) or fatal_error( 'MySQL Error: ' . mysql_errno() );
	$aResultTotal = mysql_fetch_array($rResultTotal);
	$iTotal = $aResultTotal[0];
	
	
	/*
	 * Output
	 */
	 /*
     * ส่วนการแสดงผล
     */
	$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);
	
	$n = 0;
	while ( $aRow = mysql_fetch_array( $rResult ) )
	{
		$row = array();		
		$n++;
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			//echo $aColumns[$i]."/n";
			
			//print_r($aColumns[$i]);
			
			$row[0] = $n+$_REQUEST['iDisplayStart'];
			
					
			if ( $aColumns[$i] == "firstName" ){
				$row[1] = $aRow[ $aColumns[$i] ]." ".$aRow['lastName'];			
			}
			
			if ( $aColumns[$i] == "telephone" ){
				$row[2] = $aRow[ $aColumns[$i] ];			
			}
			
			if ( $aColumns[$i] == "callTime" ){
				$row[3] = $aRow[ $aColumns[$i] ];			
			}
			
			if ( $aColumns[$i] == "startPlace" ){
				$row[4] = $aRow[ $aColumns[$i] ];			
			}
			
			if ( $aColumns[$i] == "statusWork" ){
				if ( $aRow['statusWork'] == '1' ){
					$set_text = "<div style=\"color:#090;\">เรียกแท๊กซี่</div>";			
				}				
				if ( $aRow['statusWork'] == '' ){
					$set_text = "<div style=\"color:#090;\">กำลังเลือกแท๊กซี่</div>";			
				} 																
				if ( $aRow['statusWork'] == '2' ){
					$set_text = "<div style=\"color:#C00;\">ให้บริษัทเลือกรถให้</div>";			
				} 
				if ( $aRow['statusWork'] == '3' ){
					$set_text = "<div style=\"color:#060;\">ส่งรถให้ลูกค้า</div>";			
				} 
				if ( $aRow['statusWork'] == '4' ){
					$set_text = "<div style=\"color:#666;\">เลือกรถแท๊กซี่แล้ว</div>";			
				} 
				

				$row[5] = $set_text."<div style=\"font-style:italic; color:#999; font-size:12px;\">".$aRow['generateCode']."</div>";
			}
			
			
			if ( $aColumns[$i] == 'historyId' )
			{
				$set_tools = " <a href=\"#\" class=\"show_on_map btn btn-gebo btn-mini\" onclick=\"showCustomer('".$aRow['customerId']."','".$aRow['startLatitude']."','".$aRow['startLongitude']."','".$aRow['historyId']."');\">ดูตำแหน่ง</a> ";
				
				if ($aRow['statusWork'] == '2' ){
					$set_tools .= " <a href=\"#\" class=\"show_on_map btn btn-warning btn-mini\" onclick=\"callTaxi('".$aRow['customerId']."','".$aRow['startLatitude']."','".$aRow['startLongitude']."','".$aRow['historyId']."');\">เลือกแท๊กซี่</a> ";	
				} 
				
				$row[6] = $set_tools;
			}			
		}
		$output['aaData'][] = $row;
	}
	
	echo json_encode( $output );
?>