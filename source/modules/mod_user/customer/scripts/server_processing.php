<?php
	header('Content-Type: text/html; charset=utf-8');
	
/*	$aColumns = array(
		'driverId',
		'firstName',
		'lastName',
		'drivertaxi.username',
		'citizenId',
		'licenseNumber',
		'credits',
		'drivertaxi.mobilePhone',
		'drivertaxi.dateAdd',
		'drivertaxi.garageId',
		'thaiCompanyName',
		'englishCompanyName',
		'drivertaxi.lock'
	);*/
	
	$aColumns = array(
		'customerId',
		'email',
		'password',
		'firstName',
		'lastName',
		'citizenId',
		'credits',
		'location',
		'birthday',
		'telephone',
		'dateAdded',
		'gender',
		'customer.lock'
	);	
	
	/* Indexed column (used for fast and accurate table cardinality) */
//	$sIndexColumn = "carId";
	$sIndexColumn = "customerId";
	
	/* DB table to use */
/*  $sTable = "car";
	$garageId = $_REQUEST['garageId']; */ 
	$sTable = "customer";
/*	$garageId = $_REQUEST['garageId'];
	$u_garage = $_REQUEST['u_garage'];
*/	
   	// Joins
	//$sJoin = 'LEFT JOIN mobilecustomer ON((mobilecustomerId = customerId)) ';
	$sJoin = '';
	
/*	$sJoin = 'JOIN carmodel ON((carmodel.carModelId = car.carModelId)) ';
	$sJoin .= 'JOIN carbanner ON((carbanner.carBannerId = car.carBannerId)) ';
	$sJoin .= 'JOIN province ON((province.provinceId = car.provinceId)) ';
	$sJoin .= 'JOIN majoradmin ON((majoradmin.garageId = car.garageId)) ';*/
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
	
/*	if ($garageId != ''){
		//$sWhere = "where car.garageId = '".$garageId."'";
		$sWhere = "where drivertaxi.garageId = '".$garageId."'";
	} else {
		$sWhere = "";
	}
*/	//$sSearch = iconv("tis-620","utf-8",$_GET['sSearch']);
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
	$num = 0;
	while($aRow = mysql_fetch_array($rResult))
	{
		$num++;

		$row = array();
		for($i=0;$i<count($aColumns);$i++)
		{
			$row[0] = $_REQUEST['iDisplayStart'] + $num;
					
			if($aColumns[$i] == 'firstName')
			{
				$row[1] = "<a href=\"index.php?p=user.customercheck&menu=main_user&customerId=".$aRow['customerId']."\" title=\"ข้อมูลการใช้งานลูกค้า\">".$aRow['firstName'].' '.$aRow['lastName']."</a>";	
			}
			if($aColumns[$i] == 'email')
			{
				$row[2] = $aRow['email']	;
			}
			if($aColumns[$i] == 'citizenId')
			{
				$row[3] = $aRow['citizenId'];	
			}
			if($aColumns[$i] == 'credits')
			{
				$row[4] = $aRow['credits'];	
			}
			if($aColumns[$i] == 'telephone')
			{
				$row[5] = $aRow['telephone'];
			}
			if ($aColumns[$i] == "dateAdded"){
				$row[6] = Thai_date($aRow['dateAdded']);
			}					
			if ( $aColumns[$i] == 'customerId' )
			{
				$set_tools = "<a style=\"cursor:pointer;\" class=\"ttip_t\" title=\"แก้ไข\" onClick=\"fn_Edit(".$aRow['customerId'].")\" ><i class=\"icon-pencil\"></i></a>";
				$set_tools .= " <a style=\"cursor:pointer;\" class=\"ttip_t\" title=\"เพิ่มเครดิต\" onClick=\"fn_addCredit(".$aRow['customerId'].",'".$aRow['firstName'].' '.$aRow['lastName']."')\" ><i class=\"splashy-heart_add\"></i></a>";
				$row[7] = $set_tools;
					
				$set_tools2 = "<div id=\"div_lock".$aRow['customerId']." style=\"float:left; margin-left:5px;\">";   
				if ($aRow['lock'] == 0) {						
					$set_tools2 = $set_tools2."<a href=\"#\" class=\"ttip_t\" title=\"สถานะล๊อค\" onclick=\"fn_changeLock('".$aRow['customerId']."',1);\"><i class=\"splashy-thumb_down\"></i></a>";
				} else {
					$set_tools2 = $set_tools2."<a href=\"#\" class=\"ttip_t\" title=\"สถานะไม่ล๊อค\" onclick=\"fn_changeLock('".$aRow['customerId']."',0);\"><i class=\"splashy-thumb_up\"></i></a>";
				}					
              	$set_tools2 = $set_tools2."</div>";
				
				$row[8] = $set_tools2;
			}			
		}
		$output['aaData'][] = $row;
	}

	echo json_encode( $output );
?>