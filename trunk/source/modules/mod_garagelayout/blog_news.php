<div><img src="../../modules/mod_garagelayout/img/content-head-news.png"></div>
<div class="bgBlock" style="border-radius:0px 0px 30px 30px; height:200px; width:360px; margin-left:4px;">
    <?
    $sql_news = "SELECT * FROM news WHERE garageId = '".$garageId."' and statusShow = 1 order by dateUpdate DESC Limit 0,2 ";
    $rs_news = mysql_query($sql_news);
    while ($data_news = mysql_fetch_object($rs_news)){
    ?>
        <div style="padding:5px; margin-left:15px; margin-right:15px;">
            <!--<span class="icon-bullhorn"></span> -->                               
             <span style="color:#666; font-size:16px;"><?=$data_news->newsTopic?></span>
             <div style="float:right; margin-top:20px;">
             <a href="#myModalNews<?=$data_news->newsId?>" role="button" data-toggle="modal" style="color:#093;">
                อ่านต่อ>>>
             </a>
             </div>
            <hr>
            
        </div>
        
        <!-- Modal News -->
        <div id="myModalNews<?=$data_news->newsId?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 id="myModalLabel" style="color:#06C;"><span class="icon-bullhorn"></span> <?=$data_news->newsTopic?></h4>
          </div>
          <div class="modal-body">
            <p><?=$data_news->newsDetail?></p>
          </div>
          <div class="modal-footer">
            <button class="btn btn-warning" data-dismiss="modal" aria-hidden="true">ปิด</button>
          </div>
        </div>
        
    <? } ?>
    
</div>