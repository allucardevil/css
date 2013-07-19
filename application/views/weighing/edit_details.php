<div class="container-fluid">
	<div class="row-fluid">
    
    	<div class="row-fluid">
        	<div class="block">
            	<a href="#page-stats" class="block-heading" data-toggle="collapse">Edit Details Outgoing</a>
        		<div id="page-stats" class="block-body collapse in">
                
                
                	<p>
                    
                    <?php echo form_open('weighing/outgoing/update_details'); 
						foreach ($query_details as $row){}
					?>
                    <div class="row-fluid">
                      <div class="span2">Weighing Outgoing No</div>
                      <div class="span4"><input name="outgoing_no" class="span12" value="<?php echo $row->wod_wo_no; ?>" type="text" readonly></div>
                    </div> 
                    <div class="row-fluid">
                      <div class="span2">Shipper Name</div>
                      <div class="span4">
						<input name="shipper_name" class="span12" placeholder="ALL" value="<?php echo $row->wod_shipper_name; ?>" type="text">
                      </div>
                    </div> 
                    <div class="row-fluid">
                      <div class="span2">Shipper Address</div>
                      <div class="span4">
						<textarea name="shipper_address" class="span12" placeholder="ALL" ><?php echo $row->wod_shipper_address; ?></textarea>
                      </div>
                    </div> 
                    <div class="row-fluid">
                      <div class="span2">Shipper Phone</div>
                      <div class="span4">
						<input name="shipper_phone" class="span12" value="<?php echo $row->wod_shipper_phone; ?>" type="text">
                      </div>
                    </div> 
                    <div class="row-fluid">
                      <div class="span2">Shipper Fax</div>
                      <div class="span4">
						<input name="shipper_fax" class="span12" value="<?php echo $row->wod_shipper_fax; ?>" type="text">
                      </div>
                    </div> 
					 <div class="row-fluid">
                      <div class="span2">Shipper Email</div>
                      <div class="span4">
						<input name="shipper_email" class="span12" placeholder="ALL" value="<?php echo $row->wod_shipper_email; ?>" type="text">
                      </div>
                    </div> 
                   
                    
					<div class="row-fluid">
                      <div class="span2">Consignee Name</div>
                      <div class="span4">
						<input name="consignee_name" class="span12" value="<?php echo $row->wod_consignee_name; ?>"  type="text">
                      </div>
                    </div> 
                    <div class="row-fluid">
                      <div class="span2">Consignee Address</div>
                      <div class="span4">
						<textarea name="consignee_address" class="span12" ><?php echo $row->wod_consignee_address; ?></textarea>
                      </div>
                    </div> 
                    <div class="row-fluid">
                      <div class="span2">Consignee Phone</div>
                      <div class="span4">
						<input name="consignee_phone" class="span12" value="<?php echo $row->wod_consignee_phone; ?>" type="text">
                      </div>
                    </div> 
                    <div class="row-fluid">
                      <div class="span2">Consignee Fax</div>
                      <div class="span4">
						<input name="consignee_fax" class="span12" value="<?php echo $row->wod_consignee_fax; ?>" type="text">
                      </div>
                    </div> 
					 <div class="row-fluid">
                      <div class="span2">Consignee Email</div>
                      <div class="span4">
						<input name="consignee_email" class="span12" value="<?php echo $row->wod_consignee_email; ?>" type="text">
                      </div>
                    </div> 
                    <div class="row-fluid">
                      <div class="span2"></div>
                      <div class="span2"><button class="btn btn-primary btn-large" type="submit">UPDATE</button></div>
                      <div class="span2"><button class="btn btn-primary btn-large" type="reset">CANCEL</button></div>
                    </div>
                  
                    <?php 
					
					echo form_close(); ?>
                      
           			</p>
                
			
                
				
                
                
               
               
               
                </div>
            </div>
        </div>
        
	</div>
</div>