<? if($_REQUEST['menu']=="main_car" or $_REQUEST['menu']=="" ){?>
<div class="row-fluid">
    <div class="span6">
        <h3 class="heading" style="font-size:12px; border-bottom:1px #000 dotted; margin-bottom:7px; padding-bottom:2px;">
            <a href="index.php?menu=main_car" style="text-decoration:none;"><strong><?=$lang_menu["car"]?></strong></a>
        </h3>
    </div>    
             
    <div class="span12" style="text-align:left;">
        <ul class="dshb_icoNav tac" style="text-align:left;">
        	<? include("modules/mod_car/menu/menu.car.main.php"); ?>
    	</ul>
    </div>
</div>
<? }?>