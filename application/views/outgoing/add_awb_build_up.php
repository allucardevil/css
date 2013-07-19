<div class="container-fluid">
	<div class="row-fluid">
    
    	  
    	<div class="row-fluid">
        	<div class="block">
            	<a href="#data-build-up" class="block-heading" data-toggle="collapse">DATA BUILD UP</a>
        		<div id="data-build-up" class="block-body collapse in">
                
                <div class="row-fluid">
                    <table class="table table-bordered">
                        <tr class="success">
                        	<th>ULD No</th>
                            <th>Flight No</th>
                            <th>Origin</th>
                            <th>Dest</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
						<?php 
							foreach($build_up as $bu){
							$uld = $bu->obu_uld;
						?>
						<tr>
							<td><?php echo $bu->obu_uld ; ?></td>
							<td><?php echo $bu->obu_flight_no ; ?></td>
							<td><?php echo strtoupper($bu->obu_from) ; ?></td>
							<td><?php echo strtoupper($bu->obu_to) ; ?></td>
							<td><?php echo mdate("%d-%m-%Y",strtotime($bu->obu_date)) ; ?></td>
							<td>action</td>
						</tr>
						<?php
							};
						?>
						
                    </table>
                </div>
               
          	</div>
       	</div>
   	</div>     
    
    <div class="row-fluid">
        	<div class="block">
            	<a href="#build-up-details" class="block-heading" data-toggle="collapse">AWB DATA (BUILD UP DETAILS)</a>
        		<div id="build-up-details" class="block-body collapse in">           
                
				<div class="row-fluid">
                 
                 	<table class="table table-bordered">
                        <tr>
                        	<th>AWB</th>
                            <th>Pcs</th>
                        	<th>Weight</th>
							<th>Status</th>
                            <th>Action</th>
                       	</tr>
                        <?php foreach($build_up_details as $bud){ 
							if($bud->obud_status == 'active')
							{
								echo '<tr class="success">' ;
								echo '<td>' . strtoupper($bud->obud_awb) . '</td>';
							}
							else
							{
								echo '<tr class="error">';
								echo '<td><del>' . strtoupper($bud->obud_awb) . '</del></td>';
							}
						?>
							<td><?php echo $bud->obud_piece; ?></td>
							<td><?php echo $bud->obud_weight; ?></td>
							<td><?php echo $bud->obud_status; ?></td>
							<td><?php if($bud->obud_status == 'active')
								{ 
									echo anchor('outgoing/delete_awb_build_up/' . $uld . '/' . $bud->obud_id , '<i class="icon-remove "></i>', array('rel' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'delete weight item')); 
								}
								?>
							</td>
						</tr>
						<?php } ?>
						
                    </table>    
                      
				</div>
          	</div>
       	</div>
   	</div> 
    
    <div class="row-fluid">
        	<div class="block">
            	<a href="#add-weight" class="block-heading" data-toggle="collapse">ADD AWB</a>
        		<div id="add-weight" class="block-body collapse in">           
				
                 <div class="row-fluid">
                  		
                        <table class="table table-bordered">
                            <tr>
                            	<th>AWB No.</th>
                                <th>PCS</th>
                                <th>Weight</th>
                                <th>Action</th>
                            </tr>
                            
                            <?php echo form_open('outgoing/build_up/save_awb'); ?> 
               				<?php echo form_hidden('uld', $uld); ?>
                            
                            <tr>
                            	<td class="span5">
                                	<input name="awb_no" class="span5" type="text" >
                                </td>
                                <td>
                                	<input name="pcs" class="span5" type="text" value="0">
                                </td>
                                <td>
                                	<input name="weight" class="span6" placeholder="select date" type="text" value="0">
                                </td>
                                <td><?php echo form_submit('submit', 'Add', 'class="btn btn-primary"'); ?></td>
                                
                            </tr>
                            
                            <?php echo form_close(); ?>
                            
                        </table>
                </div>
                </div>
            </div>
        </div>
        
               
               
               
        
	</div>
</div>