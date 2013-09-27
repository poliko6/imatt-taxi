 <?
 $data_ready = select_db('configuration',"Where configName = 'time_ready'");
 $time_ready = $data_ready[0]['configValue'];
 
 $data_working = select_db('configuration',"Where configName = 'time_working'");
 $time_working = $data_working[0]['configValue'];
 
 $data_orderjob = select_db('configuration',"Where configName = 'time_orderjob'");
 $time_orderjob = $data_orderjob[0]['configValue'];

 $data_other = select_db('configuration',"Where configName = 'time_other'");
 $time_other = $data_other[0]['configValue'];
 ?>
 
 
 
 
  
 <div class="row-fluid">
 	<div class="span3"></div>
    <div class="span6"  style="margin-top:10px;">
        <form class="form-horizontal well" method="post"  id="fm_search">
            <fieldset>
                <p class="f_legend">เวลาในการส่งค่าพิกัดของมือถือ</p>
                
                <div class="control-group">
                    <label class="control-label">เวลาสถานะว่าง (Ready) </label>
                    <div class="controls">                        
                        <input type="text" name="time_ready" id="time_ready" class="span2" value="<?=$time_ready?>" disabled="disabled" /> &nbsp; วินาที                     
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">เวลาสถานะกำลังไปรับงาน (Order job) </label>
                    <div class="controls">                        
                        <input type="text" name="time_orderjob" id="time_orderjob" class="span2" value="<?=$time_orderjob?>" disabled="disabled" /> &nbsp; วินาที                     
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label">เวลาสถานะกำลังทำงาน (Working) </label>
                    <div class="controls">                        
                        <input type="text" name="time_working" id="time_working" class="span2" value="<?=$time_working?>" disabled="disabled" /> &nbsp; วินาที                     
                    </div>
                </div>
                                
                <div class="control-group">
                    <label class="control-label">เวลาสถานะอื่นๆ  (Other) </label>
                    <div class="controls">                        
                        <input type="text" name="time_other" id="time_other" class="span2" value="<?=$time_other?>" disabled="disabled" /> &nbsp; วินาที                     
                    </div>
                </div>
                
                
                <div class="control-group">
                    <div class="controls">
                        <input class="btn btn-danger" type="submit" value="แก้ไขเวลา">
                    </div>
                </div>
            </fieldset>
            <input type="hidden" name="act" value="edittime" />
            <input type="hidden" name="p" value="<?=$p?>" />
            <input type="hidden" name="menu" value="<?=$menu?>" />
        </form>
    </div>
   <div class="span3"></div>
</div>