 <?
 $car_type = select_db('cartype','order by carTypeId');
 $total = count($car_type);
 ?>
 

<!-- POP UP -->
<div class="modal hide fade" id="myModalAdd">
    <div class="modal-header">
        <h3>เพิ่มประเภทรถยนต์</h3>
    </div>
    <div class="modal-body">
        <div class="formSep">
            <label>ชื่อประเภทรถยนต์</label>
            <input type="text" name="type_name" id="type_name" value="" />
            <span class="help-inline">ตัวอย่าง : รถเก๋ง</span>
        </div> 
    </div>
    <div class="modal-footer">        
        <a href="#" class="btn btn-primary"><i class="splashy-check"></i>บันทึก</a>
        <a href="#" class="btn" data-dismiss="modal"><i class="splashy-error_small"></i>ยกเลิก</a>
    </div>
</div>


<div class="modal hide fade" id="myModalDel" style="text-align:center; width:500px;">
    <div class="alert alert-block alert-error fade in">
        <h4 class="alert-heading">คุณต้องการลบข้อมูลนี้!</h4>
        <div style="height:50px;"></div>
        <p><a href="#" class="btn btn-inverse"><i class="splashy-check"></i> ยืนยันการลบข้อมูล</a> หรือ <a href="#" class="btn" data-dismiss="modal"><i class="splashy-error_small"></i> ยกเลิก</a></p>
    </div>
</div>
 
 
 
 
 <div class="row-fluid search_page">
	<div class="span12">
        <div class="well clearfix">
            <div class="row-fluid">
                <div class="pull-left">รายการประเภทรถทั้งหมด <strong><?=$total?></strong></div>
                <div class="pull-right">
                  <a data-toggle="modal" data-backdrop="static" href="#myModalAdd">
                  	<button class="btn btn-success" onClick="">เพิ่มประเภทรถ</button></a>  
                </div>
            </div>
        </div>
        
  
  		
  
		<? if ($total != 0){ ?>
        <table class="table table-striped table-bordered dTableR" id="smpl_tbl">
            <thead>
                <tr>
                    <th style="width:10px">ลำดับ</th>
                    <th style="width:250px">ชื่อประเภท</th>
                    <th style="width:120px">วันที่เพิ่ม</th>
                    <th style="width:100px">เครื่องมือ</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            	
                	
                
				<? 
                $i = 0;
                while ($i < $total) {                    
                    ?>
                    <tr>                   
                        <td style="text-align:center;"><?=$i+1?></td>
                        <td><?=$car_type[$i]['carTypeName']?></td>
                        <td><?=Thai_date($car_type[$i]['dateAdd'])?></td>
                        <td>
                        <!--<a data-toggle="modal" data-backdrop="static" href="#myModalAdd"> -->
                            <a href="#" class="sepV_a" title="Edit"><i class="icon-pencil"></i></a>
                            <a href="#myModalDel" data-toggle="modal" title="Delete"><i class="icon-trash"></i></a>
                        </td>
                        <td></td>
                    </tr>
                	<? 
					$i++;
				} ?>
               
            </tbody>
        </table>
         <? } else {  ?>
            <div style="text-align:center;">
                <strong>ยังไม่มีข้อมูล!</strong>
            </div>
         <? } ?>
        
    </div>
</div>