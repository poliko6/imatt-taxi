<nav>
    <div id="jCrumbs" class="breadCrumb module">
        <ul>
            <li>
                <a href="#"><i class="icon-home"></i></a>
            </li>
            <li>
                <strong style="color:#069;">ระบบการจัดการรถแท๊กซี่ (Taxi managemanet system)</strong>
            </li>
        </ul>                            
    </div>
</nav>


<div id="left">
  <? 
  	//pre($_REQUEST);
  	if($_REQUEST['p']<>"")
	{ 
		$part_p = explode('.',$_REQUEST['p']);
		//pre($part_p);
		include("modules/mod_".$part_p[0]."/".$part_p[1]."/".$_REQUEST['p'].".php"); 
	} else {
  ?>
      <div id="cpanel">
        <table width="100%" border="0" cellspacing="1" cellpadding="1">
          <tr>
            <td><div style="width:1000px;">
                <? include("menu/main.menu.php"); ?>
              </div></td>
          </tr>
        </table>
      </div>
  <? } ?>
</div>
