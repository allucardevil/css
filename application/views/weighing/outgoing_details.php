<div class="container-fluid">
	<div class="row-fluid">
    
    	<div class="row-fluid">
        	<div class="block">
            	<a href="#page-stats" class="block-heading" data-toggle="collapse">DETAILS BTB OUTGOING</a>
        		<div id="page-stats" class="block-body collapse in">
                
                
                <div class="row-fluid">
                    <table class="table table-bordered">
                    	<tr>
                        	<th colspan="9">BTB DATA</th>
                        </tr>
                        <tr class="success">
                        	<th>No SMU</th>
                        	<th>No BTB</th>
                            <th>Date</th>
                            <th>Agent</th>
                            <th>Airline</th>
                            <th>Origin</th>
                            <th>Dest</th>
                            <th>Final Dest</th>
                            <th>Payment Status</th>
                        </tr>
                        
                        
                        
                        <?php foreach($query_data as $row): ?>
               			<?php $wo_no = $row->wo_no; ?>
                        <?php 
							if($row->wo_status == 'unpaid')
							{
								echo '<tr class="success">' ;
							}
							else
							{
								echo '<tr class="error">';
							}
						?>
                        
                        <?php foreach($query_details as $row_details): ?>
                        	<td><?php if($row_details->wod_awb == NULL){ echo '- ';} 
									 if($row->wo_status == "paid"){
										echo anchor('weighing/outgoing/edit_awb/' . $row->wo_no, '<i class="icon-pencil pull-right"></i>', 'edit air way bill');
									}
								?>
							</td>
                        <?php endforeach; ?>
                        
                        	<td><?php echo $row->wo_no; ?></td>
                            <td><?php echo mdate("%d-%m-%Y",strtotime($row->wo_date)); ?></td>
                            <td><?php echo $row->wo_agent; ?></td>
                            <td><?php echo strtoupper($row->wo_airline); ?></td>
                            <td><?php echo strtoupper($row->wo_origin); ?></td>
                            <td><?php echo strtoupper($row->wo_destination); ?></td>
                            <td><?php echo strtoupper($row->wo_final_dest); ?></td>
                            <td><?php echo strtoupper($row->wo_status); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                
                <div class="row-fluid">
                	<div class="span6">
                    	<table class="table table-bordered">
                    	<tr>
                        	<th>SHIPPER</th>
							<th><?php echo anchor('weighing/outgoing/edit_details/' . $row->wo_no, '<i class="icon-pencil pull-right"></i>', 'edit'); ?></th>
                        </tr>
                        <?php foreach($query_details as $row_details): ?>
                        <tr>
                        	<td class="span2">Name</td>
                            <td><?php echo $row_details->wod_shipper_name; ?></td>
                        </tr>
                        
                        <tr>
                        	<td>Address</td>
                            <td><?php echo $row_details->wod_shipper_address; ?></td>
                        </tr>
                        
                        <tr>
                        	<td>Phone</td>
                            <td><?php echo $row_details->wod_shipper_phone; ?></td>
                        </tr>
                        
                        <tr>
                        	<td>Fax</td>
                            <td><?php echo $row_details->wod_shipper_fax; ?></td>
                        </tr>
                        
                        <tr>
                        	<td>Email</td>
                            <td><?php echo $row_details->wod_shipper_email; ?></td>
                        </tr>
                        <?php endforeach; ?>
                        </table>
                    </div>
                    
                    <div class="span6">
                    	<table class="table table-bordered">
                    	<tr>
                        	<th colspan="2">CONSIGNEE <?php echo anchor('weighing/outgoing/edit_details/' . $row->wo_no, '<i class="icon-pencil  pull-right"></i>'); ?></th>
                        </tr>
                        <?php foreach($query_details as $row_details): ?>
                        <tr>
                        	<td class="span2">Name</td>
                            <td><?php echo $row_details->wod_consignee_name; ?></td>
                        </tr>
                        
                        <tr>
                        	<td>Address</td>
                            <td><?php echo $row_details->wod_consignee_address; ?></td>
                        </tr>
                        
                        <tr>
                        	<td>Phone</td>
                            <td><?php echo $row_details->wod_consignee_phone; ?></td>
                        </tr>
                        
                        <tr>
                        	<td>Fax</td>
                            <td><?php echo $row_details->wod_consignee_fax; ?></td>
                        </tr>
                        
                        <tr>
                        	<td>Email</td>
                            <td><?php echo $row_details->wod_consignee_email; ?></td>
                        </tr>
                        <?php endforeach; ?>
                        </table>
                    </div>
                </div>
                
				<div class="row-fluid">
                 
                 	<table class="table table-bordered">
                    	<tr>
                        	<th colspan="10">WEIGHT DATA</th>
                        </tr>
                        <tr>
                        	<th>Type of Goods</th>
                        	<th>Pcs</th>
                        	<th>Actual Weight</th>
                            <th>Length</th>
                            <th>Width</th>
                            <th>Height</th>
                            <th>Vol Weight</th>
                            <th>Paid Weight</th>
                            <th>Status</th>
                            <th>Action</th>
                       	</tr>
                        
                        <?php foreach($query_weight as $row): ?>
                        <?php 
							if($row->wow_display == 'y')
							{
								echo '<tr class="success">' ;
							}
							else
							{
								echo '<tr class="error">';
							}
						?>
                        
                        	<td><?php echo $row->wow_goods_id ; ?></td>
                            <td><?php echo $row->wow_piece ; ?></td>
                            <td><?php echo $row->wow_actual_weight ; ?></td>
                            <td><?php echo $row->wow_length ; ?></td>
                            <td><?php echo $row->wow_width ; ?></td>
                            <td><?php echo $row->wow_height ; ?></td>
                            <td><?php echo $row->wow_vol_weight ; ?></td>
                            <td><?php echo $row->wow_paid_weight ; ?></td>
                            <td>
								<?php 
								if($row->wow_display == 'y')
								{
									echo 'active' ;
								}
								else
								{
									echo 'void';
								}
								?>
                          	</td>
                            <td><?php echo 'action' ; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>    
                      
				</div>
                
				
                 <div class="row-fluid">
                  		
                        
                </div>
                
               
               
               
                </div>
            </div>
        </div>
        
	</div>
</div>