<div class="container-fluid">
	<div class="row-fluid">
    
    	  
    	<div class="row-fluid">
        	<div class="block">
            	<a href="#data-btb" class="block-heading" data-toggle="collapse">DATA BTB</a>
        		<div id="data-btb" class="block-body collapse in">
                
                <div class="row-fluid">
                    <table class="table table-bordered">
                        <tr class="success">
                        	<th>No BTB</th>
                            <th>Date</th>
                            <th>Agent</th>
                            <th>Airline</th>
                            <th>Origin</th>
                            <th>Dest</th>
                            <th>Final Dest</th>
                            <th>Payment Status</th>
                            <th>Action</th>
                        </tr>
                        <?php foreach($query_data as $row): ?>
               			<?php $wo_no = $row->wo_no; ?>
                        <?php $wo_status = $row->wo_status; ?>
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
                        	<td><?php echo $row->wo_no; ?></td>
                            <td><?php echo mdate("%d-%m-%Y",strtotime($row->wo_date)); ?></td>
                            <td><?php echo strtoupper($row->agent_name); ?></td>
                            <td><?php echo strtoupper($row->wo_airline); ?></td>
                            <td><?php echo strtoupper($row->wo_origin); ?></td>
                            <td><?php echo strtoupper($row->wo_destination); ?></td>
                            <td><?php echo strtoupper($row->wo_final_dest); ?></td>
                            <td><?php echo strtoupper($row->wo_status); ?></td>
                            
                            <td>
                            
                            &nbsp;    
							<?php echo anchor('weighing/outgoing/print/' . $row->wo_no, '<i class="icon-print"></i>', array('rel' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'print btb')); ?>
                            &nbsp;    
							<?php echo anchor('weighing/outgoing/add_weight/' . $row->wo_no, '<i class="icon-briefcase"></i>', array('rel' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'weight data')); ?>
                            &nbsp;
                            <?php echo anchor('weighing/outgoing/get_details/' . $row->wo_no, '<i class="icon-list-alt"></i>', array('rel' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'details data')); ?>
                            &nbsp;
                            <?php if($row->wo_status == 'unpaid')
								{ 
									echo anchor('weighing/outgoing/delete/' . $row->wo_no, '<i class="icon-remove "></i>', array('rel' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'delete btb')); 
								}
								?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
               
          	</div>
       	</div>
   	</div>     
    
    <div class="row-fluid">
        	<div class="block">
            	<a href="#weight-data" class="block-heading" data-toggle="collapse">WEIGHT DATA</a>
        		<div id="weight-data" class="block-body collapse in">           
                
				<div class="row-fluid">
                 
                 	<table class="table table-bordered">
                        <tr>
                        	<th>Type of Goods</th>
                            <th>Commodity</th>
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
								echo '<td>' . strtoupper($row->goods_name) . '</td>';
							}
							else
							{
								echo '<tr class="error">';
								echo '<td><del>' . strtoupper($row->goods_name) . '</del></td>';
							}
						?>
                        
                        	
                            <td><?php echo strtoupper($row->commodity_code) ; ?></td>
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
                            <td>&nbsp;
								<?php if($wo_status <> 'paid' && $row->wow_display == 'y')
								{ 
									echo anchor('weighing/outgoing/delete_weight/' . $wo_no . '/' . $row->wow_id , '<i class="icon-remove "></i>', array('rel' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'delete weight item')); 
								}
								?>
                           	</td>
                        </tr>
                        <?php endforeach; ?>
                    </table>    
                      
				</div>
          	</div>
       	</div>
   	</div> 
    
                    
                <?php if($wo_status == 'unpaid'){ ?> 
    
    <div class="row-fluid">
        	<div class="block">
            	<a href="#add-weight" class="block-heading" data-toggle="collapse">ADD WEIGHT</a>
        		<div id="add-weight" class="block-body collapse in">           
				
                 <div class="row-fluid">
                  		
                        <table class="table table-bordered">
                            <tr>
                            	<th>Type of Goods</th>
                                <th>PCS</th>
                                <th>Weight</th>
                                <th>Length</th>
                                <th>Width</th>
                                <th>Height</th>
                                <th>Action</th>
                            </tr>
                            
                            <?php echo form_open('weighing/outgoing/save_weight'); ?> 
               				<?php echo form_hidden('wo_no', $wo_no); ?>
                            
                            <tr>
                            	<td class="span5">
                                	 <?php 
										$drop = array();
										foreach($query_goods as $goods):
											$drop[$goods->goods_id] = strtoupper($goods->goods_name);
										endforeach;
										echo form_dropdown('goods',$drop, 'non', 'class = "span12"');
									?>
                                </td>
                                <td>
                                	<input name="pcs" class="span5" type="text" value="0">
                                </td>
                                <td>
                                	<input name="weight" class="span6" placeholder="select date" type="text" value="0">
                                </td>
                                <td>
                                	<input name="length" class="span5" placeholder="select date" type="text" value="0">
                                </td>
                                <td>
                                	<input name="width" class="span5" placeholder="select date" type="text" value="0">
                                </td>
                                <td>
                                	<input name="height" class="span5" placeholder="select date" type="text" value="0">
                                </td>
                                <td><?php echo form_submit('submit', 'Add', 'class="btn btn-primary"'); ?></td>
                                
                            </tr>
                            
                            <?php echo form_close(); ?>
                            
                        </table>
                </div>
                </div>
            </div>
        </div>
                
                <?php } ?>
               
               
               
        
	</div>
</div>