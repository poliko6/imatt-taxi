<?php
	header('Content-Type: text/html; charset=utf-8');
	
	//$aColumns = array( 'mobileImage', 'englishCompanyName', 'mobileRegistration', 'mobileBannerNameEng', 'mobileStatusId', 'mobileId' );
	$aColumns = array(
		'mobileId',
		'mobileNumber',
		'mobileBannerNameEng',
		'mobileModelName',
		'EmiMsi',
		'simId',
		'mobile.dateAdd',
		'mobileNetworkName',
		'thaiCompanyName',
		'englishCompanyName',
		'mobile.garageId',
		'mobile.lock'
	);
	
	/* Indexed column (used for fast and accurate table mobiledinality) */
	$sIndexColumn = "mobileId";
	
	/* DB table to use */
   	$sTable = "mobile";
	$garageId = $_REQUEST['garageId'];
 
   	// Joins
	$sJoin = 'JOIN mobilemodel ON((mobilemodel.mobileModelId = mobile.mobileModelId)) ';
	$sJoin .= 'JOIN mobilebanner ON((mobilebanner.mobileBannerId = mobile.mobileBannerId)) ';		
	$sJoin .= 'JOIN mobilenetwork ON((mobilenetwork.mobileNetworkId = mobile.mobileNetworkId)) ';
	$sJoin .= 'JOIN majoradmin ON((majoradmin.garageId = mobile.garageId)) ';
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
	
	if ($garageId != ''){
		if ( $sWhere == "" )
		{
			$sWhere = "WHERE mobile.garageId = '".$garageId."'";
		}
		else
		{
			$sWhere .= " AND mobile.garageId = '".$garageId."'";
		}
	} 
	
	
	
	
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
			
			
			
			if ( $aColumns[$i] == "mobileNumber" ){
				$row[1] = $aRow[ $aColumns[$i] ];			
			}
						
			if ( $aColumns[$i] == "EmiMsi" ){
				$row[2] = "<div>".$aRow[ $aColumns[$i] ]."</div><div style=\"font-style:italic; color:#999; font-size:11px;\">".$aRow['simId']."</div>";			
			}
			
			if ( $aColumns[$i] == "mobileNetworkName" ){
				$row[3] = $aRow[ $aColumns[$i] ];			
			}
			
			if ( $aColumns[$i] == "thaiCompanyName" ){
				$row[4] = "<div>".$aRow[ $aColumns[$i] ]."</div><div style=\"font-style:italic; color:#999; font-size:11px;\">".$aRow['englishCompanyName']."</div>";			
			}
			
			if ( $aColumns[$i] == "mobileBannerNameEng" ){
				$row[5] = "<div><strong>ยี่ห้อ</strong> :".$aRow[ $aColumns[$i] ]."</div><div><strong>รุ่น</strong> :".$aRow['mobileModelName']."</div>";		
			}		
			
			if ($aColumns[$i] == "mobile.dateAdd"){
				$row[6] = Thai_date($aRow['dateAdd']);
			}			
			
			if ( $aColumns[$i] == 'mobileId' )
			{
				$set_tools = "<a style=\"cursor:pointer;\" class=\"ttip_t\" title=\"แก้ไข\" onClick=\"fn_Edit(".$aRow[ $aColumns[$i] ].",".$aRow['garageId'].")\" ><i class=\"icon-pencil\"></i></a>";
				$set_tools = $set_tools."<a style=\"cursor:pointer;margin-left:5px;\" class=\"ttip_t\" title=\"ลบ\" onClick=\"fn_callDel(".$aRow[ $aColumns[$i] ].",'".$aRow['mobileNumber']."')\" ><i class=\"icon-trash\"></i></a>";
				
				$set_tools2 = "<div id=\"div_lock".$aRow[ $aColumns[$i] ]." style=\"float:left; margin-left:5px;\">";                        
				
				if ($aRow['lock'] == 0) {						
					$set_tools2 = $set_tools2."<a href=\"#\" class=\"ttip_t\" title=\"สถานะล๊อค\" onclick=\"fn_changeLock('".$aRow[ $aColumns[$i] ]."',1);\"><i class=\"splashy-thumb_down\"></i></a>";
				} else {
					$set_tools2 = $set_tools2."<a href=\"#\" class=\"ttip_t\" title=\"สถานะไม่ล๊อค\" onclick=\"fn_changeLock('".$aRow[ $aColumns[$i] ]."',0);\"><i class=\"splashy-thumb_up\"></i></a>";
				}
					
              	$set_tools2 = $set_tools2."</div>";	
				
				$row[7] = $set_tools;
				$row[8] = $set_tools2;
			}			
		}
		$output['aaData'][] = $row;
	}
	
	echo json_encode( $output );
?>