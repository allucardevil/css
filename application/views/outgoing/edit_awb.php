<div class="container-fluid">
	<div class="row-fluid">
    
    	<div class="row-fluid">
        	<div class="block">
            	<a href="#page-stats" class="block-heading" data-toggle="collapse">SEARCH BTB</a>
        		<div id="page-stats" class="block-body collapse in">
					
                	<p>
                    
                    <?php 
							echo form_open('weighing/outgoing/save_awb');
					?>
                    
                    <div class="row-fluid">
                      <div class="span2">BTB No</div>
                      <div class="span4"><input name="btb_no" class="span12" VALUE="<?php echo $btb;?>"  type="text" readonly></div>
                      <div class="span2"></div>

                    </div> 
                    <div class="row-fluid">
                      <div class="span2">AWB No</div>
                      <div class="span4"><input name="awb_no" class="span12" type="text" ></div>
                      <div class="span2"></div>
                    </div> 
					
					<div class="row-fluid">
                    	<div class="span2"><?php echo form_submit('submit', 'Submit' , 'class="btn btn-primary"'); ?></div>
                    </div>
				</p>
                
                </div>
           </div>
        </div>