<?php
	header('Content-Type: text/html; charset=utf-8');
	
	//$aColumns = array( 'carImage', 'englishCompanyName', 'carRegistration', 'carBannerNameEng', 'carStatusId', 'carId' );
	$aColumns = array(
		'carId',
		'carImage',
		'majoradmin.thaiCompanyName',
		'majoradmin.englishCompanyName',
		'carRegistration',
		'carYear',
		'provinceName',
		'carModelName',
		'carBannerNameEng',
		'carStatusId',
		'car.dateAdd',		
		'car.garageId'
	);
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "carId";
	
	/* DB table to use */
   	$sTable = "car";
	$garageId = $_REQUEST['garageId'];
 
   	// Joins
	$sJoin = 'JOIN carmodel ON((carmodel.carModelId = car.carModelId)) ';
	$sJoin .= 'JOIN carbanner ON((carbanner.carBannerId = car.carBannerId)) ';
	$sJoin .= 'JOIN province ON((province.provinceId = car.provinceId)) ';
	$sJoin .= 'JOIN majoradmin ON((majoradmin.garageId = car.garageId)) ';
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
			$sWhere = "WHERE car.garageId = '".$garageId."'";
		}
		else
		{
			$sWhere .= " AND car.garageId = '".$garageId."'";
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
	
	while ( $aRow = mysql_fetch_array( $rResult ) )
	{
		$row = array();
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			//echo $aColumns[$i]."/n";
			
			//print_r($aColumns[$i]);
			if ( $aColumns[$i] == "carImage" )
			{
				if (trim($aRow[ $aColumns[$i] ]) == ''){
					$pathimage  = 'gallery/Image10_tn.jpg';
					$pathimage2  = 'gallery/Image10_tn.jpg'; 	
				} else {
					$pathimage  = '../../../../stored/taxi/'.$aRow[ $aColumns[$i] ];
					if (file_exists($pathimage)) {  //check file			
						$pathimage  = 'stored/taxi/'.$aRow[ $aColumns[$i] ];
					} else { 						
						$pathimage  = 'gallery/Image10_tn.jpg'; 	
					}
					
					
					$pathimage2  = '../../../../stored/taxi/thumbnail/'.$aRow[$aColumns[$i]];
					if (file_exists($pathimage2)) {  //check file			
						$pathimage2  = 'stored/taxi/thumbnail/'.$aRow[$aColumns[$i]];
					} else { 						
						$pathimage2  = 'gallery/Image10_tn.jpg'; 	
					}				
					
				}	
				/* Special output formatting for 'version' column */
				//$row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
				$row[0] = "<a title=\"$aRow]['carRegistration']\" class=\"cbox_single thumbnail\"><img src='".$pathimage2."' style=\"height:50px;width:80px;\"></a>";
			}
			
			if ( $aColumns[$i] == "majoradmin.thaiCompanyName" ){
				$row[1] = "<div>".$aRow['thaiCompanyName']."</div><div style=\"font-style:italic; color:#999; font-size:11px;\">".$aRow['englishCompanyName']."</div>";			
			}
			
			if ( $aColumns[$i] == "carRegistration" ){
				$row[2] = "<div>".$aRow[ $aColumns[$i] ]."</div><div>".$aRow['provinceName']."</div>";			
			}
			
			if ( $aColumns[$i] == "carBannerNameEng" ){
				$row[3] = "<div><strong>ยี่ห้อ</strong> :".$aRow[ $aColumns[$i] ].", <strong>รุ่น</strong> :".$aRow['carModelName']."</div><div><strong>ปี</strong> :".$aRow['carYear']."</div>";		
			}
			
			if ( $aColumns[$i] == "carStatusId" ){
				
				if ($aRow[ $aColumns[$i] ] == 1) { 
                	$row[4] = "<div style='text-align:center;'><div>ว่าง</div><i class=\"splashy-marker_rounded_green\"></i></div>";                      
                } 
                if ($aRow[ $aColumns[$i] ] == 2) { 
                	$row[4] = "<div style='text-align:center;'><div>ไม่ว่าง</div><i class=\"splashy-marker_rounded_red\"></i></div>";
                } 
                if ($aRow[ $aColumns[$i] ] == 3) { 
                	$row[4] = "<div style='text-align:center;'><div>จอด</div><i class=\"splashy-marker_rounded_light_blue\"></i></div>"; 
                }
			}
			if ($aColumns[$i] == "car.dateAdd"){
				$row[5] = Thai_date($aRow['dateAdd']);
			}			
			
			if ( $aColumns[$i] == 'carId' )
			{
				$set_tools = "<a style=\"cursor:pointer;\" class=\"ttip_t\" title=\"แก้ไข\" onClick=\"fn_Edit(".$aRow[ $aColumns[$i] ].",".$aRow['garageId'].")\" ><i class=\"icon-pencil\"></i></a>";
				$set_tools = $set_tools."<a style=\"cursor:pointer;margin-left:5px;\" class=\"ttip_t\" title=\"ลบ\" onClick=\"fn_callDel(".$aRow[ $aColumns[$i] ].",'".$aRow['carRegistration']."')\" ><i class=\"icon-trash\"></i></a>";
				$row[6] = $set_tools;
			}			
		}
		$output['aaData'][] = $row;
	}
	
	echo json_encode( $output );
?>