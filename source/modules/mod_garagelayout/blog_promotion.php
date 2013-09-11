<div class="bgBlock" style="border-radius:30px 30px 30px 30px; height:315px;">
	<img src="../../modules/mod_garagelayout/img/content-head-pro.png" style="margin-left:-3px; margin-top:-3px;">

    <?
    $sql_promo = "SELECT * FROM newspromotion WHERE garageId = '".$garageId."' and statusShow = 1 order by dateUpdate DESC Limit 0,2 ";
    $rs_promo = mysql_query($sql_promo);
    while ($data_promo = mysql_fetch_object($rs_promo)){
    ?>
        <div style="padding:5px; margin-left:15px; margin-right:15px;">
            <!--<span class="icon-bullhorn"></span> -->                               
             
             <div style="text-align:center;">
             <a href="#myModalPromo<?=$data_promo->promotionId?>" role="button" data-toggle="modal" style="color:#093;">
                <span style="color:#F63; font-size:16px;"><?=$data_promo->promotionTopic?></span>
             </a>
             </div>
            <hr>
            
        </div>
        
        <!-- Modal News -->
        <div id="myModalPromo<?=$data_promo->promotionId?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 id="myModalLabel" style="color:#900;"><span class=" icon-thumbs-up"></span> <?=$data_promo->promotionTopic?></h4>
          </div>
          <div class="modal-body">
            <p><?=$data_promo->promotionDetail?></p>
          </div>
          <div class="modal-footer">
            <button class="btn btn-warning" data-dismiss="modal" aria-hidden="true">ปิด</button>
          </div>
        </div>
        
    <? } ?>
</div>