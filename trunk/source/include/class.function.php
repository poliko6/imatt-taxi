<?
	function subtext($text,$n){
		return iconv_substr($text,0,$n, "UTF-8")."...";
	}
	
	function pre($values){
		echo "<pre>"; print_r($values); echo "</pre>";
	}
	

	function DateTimeDiff($strDateTime1,$strDateTime2){

		//$date = 0;
		//$hour = 0;
		//$min = 0;
		$diff = strtotime($strDateTime2) - strtotime($strDateTime1);
		$year = floor($diff / 31536000);
		$month = floor(($diff % 31536000) / 2592000);
		$date = floor(($diff-($year*31536000)-($month*2592000))/(86400));
				
		return time_display($diff);						
	}
	
	

	function time_display($seconds)
	{
		/*** return value ***/
		$ret = "";
	
		$Day = floor($seconds/86400);
		if($Day > 0)
		{
			$ret .= "$Day Day :";
		}
									
		/*** get the hours ***/
		$hours = floor(($seconds-($Day*86400))/60.0/60.0);
	
		if($hours > 0 || $Day > 0)
		{
			$ret .= "$hours : ";
		}
		/*** get the minutes ***/
		$minutes = floor(($seconds  - (($hours * 60.0 * 60.0) + ($Day*86400)) )/60.0);
		#$minutes = bcmod((intval($seconds) / 60),60);
		if($hours > 0 || $minutes > 0)
		{
			$ret .= "$minutes : ";
		}
									
		/*** get the seconds ***/
		$seconds = floor($seconds  - ( ($hours * 60.0 * 60.0) + ($Day*86400) + ($minutes*60) ) ) ;
		$ret .= "$seconds ";
		
		if ($Day <= 0) {
			
			if ($hours > 0) {
				return $hours." ชั่วโมง";
			} else {
						
				if ($minutes > 0) {
					return $minutes." นาที";
				} else {			
					if ($seconds > 0) { return $seconds." วินาที"; }
				}
			}
			
		} else {
			return $Day." วัน";
		}
		
	}
	
	
	function Thai_date($day){
		$date = $day;
		$part = explode('-',$date);
		$thyear = $part[0];
		$month = $part[1];
		$thday = $part[2];
    	if($thday <10)
       		$thday = substr($thday,1,1);
       
    	$thMonth = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน",
                     "กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    
    	/*$thMonth = array("ม.ค.","ก.พ.","มี.ค.","ม.ย.","พ.ค.","มิ.ย.",
                     "ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");*/
    
    	$thyear +=543;
    
    	$day = $thday." ".$thMonth[$month-1]." ".$thyear;  
    	return $day;
	}
	
	function count_data_mysql($id,$tbname,$select){
		$sql = "select count($id) as totaldata from $tbname where $select";		
		$rs = mysql_query($sql);
		$data = @mysql_fetch_object($rs) ;	
		$totaldata = $data->totaldata;		
		#echo $sql;
		return $totaldata;
	}
	
	/*
วิธีใช้
$data = array(
        $Table_Member.'_firtname'=>$_POST['firstname'],
        $Table_Member.'_lastname'=>$_POST['lastname'],
        $Table_Member.'_nicname'=>$_POST['nicname']
);
$sql = insert_db($Table_Member, $data);
mysql_query($sql);
*/ 
    function insert_db($nameTable, $data){
        while($element = each($data)){
            $insert[$element["key"]]="'".$element["value"]."'";
        }
        return $sql = "INSERT INTO `".$nameTable."` (".implode(",",array_keys($insert)).") VALUES (".implode(",",array_values($insert)).")";
    }

/*
วิธีใช้
$data = array(
        $Table_Member.'_firtname'=>$_POST['firstname'],
        $Table_Member.'_lastname'=>$_POST['lastname'],
        $Table_Member.'_nicname'=>$_POST['nicname']
);
$sql = update_db($Table_Member, array($Table_Member.'_id='=>$_POST['fid']), $data);
mysql_query($sql);
*/   
    function update_db($nameTable, $where, $data){
        while($element = each($data)){
            $update[$element["key"]]="`".$element["key"]."`='".$element["value"]."'";
        }
        while($element2 = each($where)){
            $where[$element2["key"]]=$element2["key"]."'".$element2["value"]."'";
        }
		#echo $sql = "UPDATE `".$nameTable."` SET ".implode(",",$update)." WHERE ".implode(",",$where);
        return $sql = "UPDATE `".$nameTable."` SET ".implode(",",$update)." WHERE ".implode(",",$where);
    }

/*
วิธีใช้
$sql = delete_db($Table_Member, array($Table_Member.'_id='=>$_GET['id']));
mysql_query($sql);
*/   
    function delete_db($nameTable, $where){
        while($element = each($where)){
            $where[$element["key"]]=$element["key"]."'".$element["value"]."'";
        }
        return $sql = "DELETE FROM ".$nameTable." WHERE ".implode(",",$where);
    }
	
	
	function select_db($table,$condition)
	{
		$sql = "select * from $table $condition";
		$dbquery = mysql_query($sql);
		#echo $sql;
		$rows = array();
		while (($result= mysql_fetch_array($dbquery)) !== FALSE)
		$rows[] = $result;
		return $rows;
	}

?>