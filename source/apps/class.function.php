<?
	function pre($values){
		echo "<pre>"; print_r($values); echo "</pre>";
	}
	
	
	//id ไม่เปลี่ยน
	function aasort (&$array, $key) {
		$sorter=array();
		$ret=array();
		reset($array);
		foreach ($array as $ii => $va) {
			$sorter[$ii]=$va[$key];
		}
		asort($sorter);
		foreach ($sorter as $ii => $va) {
			$ret[$ii]=$array[$ii];
		}
		$array=$ret;
	}
	
	//id เรียงใหม่
	function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
		$sort_col = array();
		foreach ($arr as $key=> $row) {
			$sort_col[$key] = $row[$col];
		}
	
		array_multisort($sort_col, $dir, $arr);
	}
	
	function createRandomPassword() { 

		$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"; 
		srand((double)microtime()*1000000); 
		$i = 0; 
		$pass = '' ; 
	
		while ($i <= 7) { 
			$num = rand() % 33; 
			$tmp = substr($chars, $num, 1); 
			$pass = $pass . $tmp; 
			$i++; 
		} 
	
		return $pass; 

	} 
?>