<? if($_REQUEST['menu']=="main_user" or $_REQUEST['menu']=="" ){?>
<div class="row-fluid">
    <div class="span6">
        <h3 class="heading" style="font-size:12px; border-bottom:1px #000 dotted; margin-bottom:7px; padding-bottom:2px;">
            <a href="index.php?menu=main_user" style="text-decoration:none;"><strong><?=$lang_menu["user"]?></strong></a>
        </h3>
    </div>    
             
    <div class="span12" style="text-align:left;">
        <ul class="dshb_icoNav tac" style="text-align:left;">
        	<? include("modules/mod_user/menu/menu.user.main.php"); ?>
    	</ul>
    </div>
</div>
<? }?>