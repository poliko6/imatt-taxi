<?php
	header('Content-Type: text/html; charset=utf-8');
	
	//$aColumns = array( 'carImage', 'englishCompanyName', 'carRegistration', 'carBannerNameEng', 'carStatusId', 'carId' );
	$aColumns = array(
		'transportSectionId',
		'car.carRegistration',
		'transportsection.driverId',
		'transportsection.carId',
		'transportsection.mobileId',
		'mobile.mobileNumber',
		'province.provinceName',
		'mobile.latitude',
		'mobile.longitude',
		'drivertaxi.firstName',
		'drivertaxi.lastName',
		'transportsection.dateAdd',
		'transportsection.timeStart',
		'transportsection.timeEnd',
		'transportsection.garageId',
		'transportsection.statusWork'
	);
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "transportSectionId";
	
	/* DB table to use */
   	$sTable = "transportsection";
	$garageId = $_REQUEST['garageId'];
 	$d = $_REQUEST['d'];
	
   	// Joins
	$sJoin = 'JOIN car ON((car.carId = transportsection.carId))';
	$sJoin .= 'JOIN mobile ON((mobile.mobileId = transportsection.mobileId))';
	$sJoin .= 'JOIN province ON((province.provinceId = car.provinceId))';
	$sJoin .= 'JOIN drivertaxi ON((drivertaxi.driverId = transportsection.driverId))';
   	//$sJoin = 'LEFT JOIN users u ON u.id = regina_dslams.user_id ';
   	//$sJoin .= 'LEFT JOIN regina_dslam_types ON regina_dslam_types.id = regina_dslams.regie_dslam_type_id ';
   	//$sJoin .= 'LEFT JOIN regina_statuses iptv_status ON iptv_status.id = regina_dslams.regie_status_iptv_id ';
    //$sJoin .= 'LEFT JOIN regina_statuses wba_status ON wba_status.id = regina_dslams.regie_status_wba_id ';
	
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
	
	if ($garageId != ''){
		if ($sWhere == "" )
		{			
			$sWhere = "WHERE transportsection.garageId = '".$garageId."' ";
			if ($d != ''){
				$sWhere = $sWhere."AND transportsection.dateAdd like '".$d."%' ";
			} else {
				$sWhere = $sWhere."AND transportsection.statusWork in ('online','offline') ";
			}
		}
		else
		{
			$sWhere = $sWhere." AND transportsection.garageId = '".$garageId."' ";
			
			if ($d != ''){				
				$sWhere = $sWhere."AND transportsection.dateAdd like '".$d."%' ";
			} else {
				//if ($d == date('Y-m-d')){ } 
				$sWhere = $sWhere."AND transportsection.statusWork in ('online','offline') ";
			}
		}
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
			
			$row[0] = $n+$_REQUEST['iDisplayStart'];
			
			
			
			if ($aColumns[$i] == "drivertaxi.firstName"){
				$setrow1 = "<i class=\"splashy-contact_grey\"></i>";
				$setrow1 .= "<a href=\"#\" style=\"margin-left:5px;\" class=\"ttip_t\" title=\"ดูรายละเอียดเพิ่มเติม\" onclick=\"fn_showInfoDriver(".$aRow['driverId'].")\">";
				$setrow1 .= $aRow['firstName']." ".$aRow['lastName']."</a>";	
				$row[1] = $setrow1;		
			}
						
			if ( $aColumns[$i] == "car.carRegistration" ){
				$setrow2 = "<a href=\"#\" class=\"ttip_t\" title=\"ดูรายละเอียดเพิ่มเติม\" onclick=\"fn_showInfoCar(".$aRow['carId'].");\">";
				$setrow2 .= $aRow['carRegistration']." ".$aRow['provinceName']."</a>";
				$row[2] = $setrow2;			
			}
			
			if ( $aColumns[$i] == "mobile.mobileNumber" ){
				$setrow3 = "<i class=\"splashy-cellphone\"></i>";
				$setrow3 .= "<a href=\"#\" style=\"margin-left:5px;\" class=\"ttip_t\" title=\"ดูรายละเอียดเพิ่มเติม\" onclick=\"fn_showInfoMobile(".$aRow['mobileId'].");\">";
				$setrow3 .= $aRow['mobileNumber']."</a>";	
				$row[3] = $setrow3;	
			}
			
			if ( $aColumns[$i] == "mobile.latitude" ){
				$row[4] = $aRow['latitude'].", ".$aRow['longitude'];			
			}
			
			if ($aColumns[$i] == "transportsection.dateAdd"){
				$row[5] = Thai_date($aRow['dateAdd']);
			}
			
			if ( $aColumns[$i] == "transportsection.timeStart" ){
				$p_time1 = explode(':',$aRow['timeStart']);
				$p_time2 = explode(':',$aRow['timeEnd']); 
				 
				$row[6] = $p_time1[0].":".$p_time1[1]." น. - ".$p_time2[0].":".$p_time2[1]." น. ";		
			}
			//$row[5] = $aRow['garageId'];	
			//$row[6] = 0;
			if ( $aColumns[$i] == "transportsection.statusWork" ){
				if ($aRow['statusWork'] == 'online') {
					$row[7] = "<span style=\"color:#0C0; font-weight:bold;\">กำลังทำงาน</span>";
				} else {
					$row[7] = "<span style=\"color:#666; font-style:italic;\">ออกจากงานแล้ว</span>";
				}				
			}				
						
			
			if ( $aColumns[$i] == 'transportSectionId' )
			{
				$set_tools = '';
				if ($aRow['statusWork'] == 'online') {                            	
					$set_tools .= "<div style=\"float:left; margin-right:5px;\">";
					$set_tools .= "<a href=\"#\" class=\"ttip_t\" data-toggle=\"modal\" data-backdrop=\"static\" title=\"ออกจากงาน\" onclick=\"fn_formEdit(".$aRow['transportSectionId'].",".$aRow['carId'].", 'select');\"><i class=\"splashy-warning\"></i></a>";
					$set_tools .= "</div>";
				} 
				$set_tools .= "<div style=\"float:left;\">";
				$set_tools .= "<a style=\"cursor:pointer;margin-left:5px;\" class=\"ttip_t\" title=\"ยกเลิก\" onClick=\"fn_callDel(".$aRow[ $aColumns[$i] ].",".$aRow['carId'].",'".$aRow['firstName']." ".$aRow['lastName']."')\" ><i class=\"splashy-remove\"></i></a>";
				$row[8] = $set_tools;
			}			
		}
		$output['aaData'][] = $row;
	}
	
	echo json_encode( $output );
?>