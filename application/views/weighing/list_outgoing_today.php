<div class="container-fluid">
	<div class="row-fluid">
    
    	
        
    	<div class="row-fluid">
        	<div class="block">
            	<a href="#page-stats" class="block-heading" data-toggle="collapse">Daily BTB Report &nbsp; &nbsp;<i class="icon-calendar"></i><?php echo mdate("%d-%m-%Y", time()); ?>  <span class="label label-important"><?php echo $total; ?></span> </a>
        		<div id="page-stats" class="block-body collapse in">
                
                
                <div class="row-fluid">
                    <table class="table table-bordered">
                    	
                        <tr>
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
                        <?php foreach($list_today as $row): ?>
               			<?php $wo_no = $row->wo_no; ?>
                        <?php 
							if($row->wo_status == 'unpaid')
							{
								echo '<tr class="warning">' ;
								echo '<td>' . $row->wo_no . '</td>';
							}
							elseif($row->wo_status == 'paid')
							{
								echo '<tr class="success">';
								echo '<td>' . $row->wo_no . '</td>';
							}
							else
							{
								echo '<tr class="error">';
								echo '<td><del>' . $row->wo_no . '</del></td>';
							}
						?>
                        	
                            <td><?php echo mdate("%d-%m-%Y",strtotime($row->wo_date)); ?></td>
                            <td><?php echo strtoupper($row->agent_name); ?></td>
                            <td><?php echo strtoupper($row->wo_airline); ?></td>
                            <td><?php echo strtoupper($row->wo_origin); ?></td>
                            <td><?php echo strtoupper($row->wo_destination); ?></td>
                            <td><?php echo strtoupper($row->wo_final_dest); ?></td>
                            <td><?php echo strtoupper($row->wo_status); ?></td>
                            <td>
                            
                            &nbsp;    
							<?php echo anchor('weighing/outgoing/add_weight/' . $row->wo_no, '<i class="icon-briefcase"></i>', array('rel' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'weight data')); ?>
                            &nbsp;
                            <?php echo anchor('weighing/outgoing/get_details/' . $row->wo_no, '<i class="icon-list-alt"></i>', array('rel' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'details data')); ?>
                            &nbsp;
                            <?php if($row->wo_status == 'unpaid')
								{ 
									echo anchor('weighing/outgoing/delete/' . $wo_no, '<i class="icon-remove "></i>', array('rel' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'delete btb')); 
								}
								?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <tr>
							<th colspan="9"><?php echo $this->pagination->create_links(); ?></th>
                      	</tr>
                    </table>
                </div>
                
			
                
				
                
                
               
               
               
                </div>
            </div>
        </div>
        
	</div>
</div>