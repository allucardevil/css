<div class="container-fluid">
	<div class="row-fluid">
    
    	<div class="row-fluid">
        	<div class="block">
            	<a href="#page-stats" class="block-heading" data-toggle="collapse">LIST BTB INCOMING | <?php echo mdate("%d-%m-%Y", time()); ?> |  <?php echo $total; ?> record found</a>
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
                        	<td><?php echo anchor('weighing/incoming/add_weight/' . $row->wi_no, $row->wi_no); ?></td>
                            <td><?php echo mdate("%d-%m-%Y",strtotime($row->wi_date)); ?></td>
                            <td><?php echo $row->wi_agent; ?></td>
                            <td><?php echo strtoupper($row->wi_airline); ?></td>
                            <td><?php echo strtoupper($row->wi_origin); ?></td>
                            <td><?php echo strtoupper($row->wi_destination); ?></td>
                            <td><?php echo strtoupper($row->wi_final_dest); ?></td>
                            <td><?php echo $row->wi_status; ?></td>
                            <td><?php echo anchor('weighing/incoming/add_weight/' . $row->wi_no, $row->wi_no); ?><i class="icon-download-alt"></i><i class="icon-pencil"></i></td>
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