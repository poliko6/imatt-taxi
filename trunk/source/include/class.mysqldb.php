<?php
	class mysqldb {
			var $link;
			var $result;
		 function connect($config) {
			$this->link = mysql_connect($config['hostname'], $config['username'], $config['password'])or die ("ไม่สามารถเชื่อมต่อฐานข้อมูลได้");
			if($this->link) {
				mysql_query("SET NAMES 'utf-8'");
				
				return true;
			}
			$this->show_error(mysql_error($this->link), "Please wait... Not Connect Database");
			return false;
		}
		function selectdb($database) {
			if($this->link) {
				mysql_select_db($database, $this->link) or die ("sas");
				return true;
			}
			$this->show_error("Not connect the database before", "selectdb($database)");
			return false;
		}
		function query($sql) {
			$this->result = mysql_query($sql);
			return $this->result;
		}
		function getnext() {
			return @mysql_fetch_object($this->result);
		}
		function num_rows() {
			return @mysql_num_rows($this->result); 
		}
		function show_error($errmsg, $func) {
			echo "<b><font color=red>" . $func . "</font></b> : " . $errmsg . "<BR>\n";
			exit(1);
		} 
	}
	

?>
