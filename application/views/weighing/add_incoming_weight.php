<div class="container-fluid">
	<div class="row-fluid">
    
    	<div class="row-fluid">
        	<div class="block">
            	<a href="#page-stats" class="block-heading" data-toggle="collapse">INPUT BTB INCOMING</a>
        		<div id="page-stats" class="block-body collapse in">
                
                
                <div class="row-fluid">
                    <table class="table table-bordered">
                    	<tr>
                        	<th colspan="8">BTB DATA</th>
                        </tr>
                        <tr class="success">
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
               			<?php $wi_no = $row->wi_no; ?>
                        <?php 
							if($row->wi_status == 'unpaid')
							{
								echo '<tr class="success">' ;
							}
							else
							{
								echo '<tr class="error">';
							}
						?>
                        	<td><?php echo $row->wi_no; ?></td>
                            <td><?php echo mdate("%d-%m-%Y",strtotime($row->wi_date)); ?></td>
                            <td><?php echo $row->wi_agent; ?></td>
                            <td><?php echo $row->wi_airline; ?></td>
                            <td><?php echo $row->wi_origin; ?></td>
                            <td><?php echo $row->wi_destination; ?></td>
                            <td><?php echo $row->wi_final_dest; ?></td>
                            <td><?php echo $row->wi_status; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
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
							if($row->wiw_display == 'y')
							{
								echo '<tr class="success">' ;
							}
							else
							{
								echo '<tr class="error">';
							}
						?>
                        
                        	<td><?php echo $row->wiw_goods_name ; ?></td>
                            <td><?php echo $row->wiw_piece ; ?></td>
                            <td><?php echo $row->wiw_actual_weight ; ?></td>
                            <td><?php echo $row->wiw_length ; ?></td>
                            <td><?php echo $row->wiw_width ; ?></td>
                            <td><?php echo $row->wiw_height ; ?></td>
                            <td><?php echo $row->wiw_vol_weight ; ?></td>
                            <td><?php echo $row->wiw_paid_weight ; ?></td>
                            <td>
								<?php 
								if($row->wiw_display == 'y')
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
                  		
                        <table class="table table-bordered">
                        	<tr>
                            	<th colspan="7">ADD WEIGHT DATA</th>
                            </tr>
                            <tr>
                            	<th>Type of Goods</th>
                                <th>PCS</th>
                                <th>Weight</th>
                                <th>Length</th>
                                <th>Width</th>
                                <th>Height</th>
                                <th>Action</th>
                            </tr>
                            
                            <?php echo form_open('weighing/incoming/save_weight'); ?> 
               				<?php echo form_hidden('wi_no', $wi_no); ?>
                            
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
                                <td>
                                	<button class="btn btn-primary" type="submit">Add</button>
                                </td>
                                
                            </tr>
                            
                           
                            
                            <?php echo form_close(); ?>
                            
                        </table>
                </div>
                
               
               
               
                </div>
            </div>
        </div>
        
	</div>
</div>