<?php
	header('Content-Type: text/html; charset=utf-8');
	
	//$aColumns = array( 'carImage', 'englishCompanyName', 'carRegistration', 'carBannerNameEng', 'carStatusId', 'carId' );
	$aColumns = array(
		'historyId',
		'startPlace',
		'finishPlace',
		'driverComment',
		'callTime',
		'driverId',
		'statusWork',			
		'customer.firstName',
		'customer.lastName'		
	);
	
	
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "historyId";
	
	/* DB table to use */
   	$sTable = "driverhistory";
	$driverId = $_REQUEST['driverId'];
 	$dateSearch = $_REQUEST['dateSearch'];
	
   	// Joins
	$sJoin = 'JOIN customer ON(customer.customerId = driverhistory.customerId)';
	//$sJoin .= 'JOIN drivertaxi ON(drivertaxi.driverId = transportsection.driverId)';
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
	//mysql_query("SET NAMES UTF8");

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

	
	$sWhere = "";
	//$sWhere = "where transportsection.garageId = '".$garageId."' and transportsection.dateAdd like '".$d."%' ";	
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
	
	
	
	//$sWhere = "where transportsection.garageId = '".$garageId."' and transportsection.dateAdd like '".$d."%' OR statusWork = 'online'";	


		if ($sWhere == "" )
		{			
			$sWhere = " WHERE callTime LIKE '".$dateSearch."%' AND driverId = '".$driverId."' ";			
		}
		else
		{
			$sWhere = $sWhere." AND callTime LIKE '".$dateSearch."%' AND driverId = '".$driverId."' ";
			
		}

	
	
	
	
	/*
	 * SQL queries
	 * Get data to display
	 */
	//iNanCM.com
	mysql_query("SET NAMES UTF8");
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
			
			$row[0] = $n+$iDisplayStart;
		
			
			
			if ($aColumns[$i] == "customer.firstName"){
				$setrow1 = "<i class=\"splashy-contact_grey\" style=\"margin-right:5px;\"></i>";				
				$setrow1 .= $aRow['firstName']." ".$aRow['lastName'];	
				$row[1] = $setrow1;		
			}
						
			if ( $aColumns[$i] == "startPlace" ){				
				$row[2] = $aRow['startPlace'];			
			}
			
			if ( $aColumns[$i] == "finishPlace" ){				
				$row[3] = $aRow['finishPlace'];			
			}
			
			if ( $aColumns[$i] == "driverComment" ){				
				$row[4] = $aRow['driverComment'];			
			}			
				
			if ( $aColumns[$i] == "callTime" ){				
				$row[5] = Thai_date($aRow['callTime']);	
			}
			
			if ( $aColumns[$i] == "historyId" ){
				
				$datenow = $aRow['callTime'];
				$pTime = explode(' ',$datenow);
				$thisTime = $pTime[1];
				
				$row[6] = $thisTime;		
			}			
			
		}
		$output['aaData'][] = $row;
	}
	
	echo json_encode( $output );
?>