<div class="container-fluid">
	<div class="row-fluid">
    
    	<div class="row-fluid">
        	<div class="block">
            	<a href="#page-stats" class="block-heading" data-toggle="collapse">INPUT BTB OUTGOING</a>
        		<div id="page-stats" class="block-body collapse in">
                
                <p>
                
                <?php echo form_open('weighing/outgoing/save'); ?> 
                
				<div class="row-fluid">
                
                      <div class="span2">
                        <label>Date</label>
                        <input name="date" class="span12" placeholder="select date" type="text" id="datepicker">
                      </div>
                      
                      <div class="span2">
                       
                      
                        <label>Airline</label>
                     	<?php 
							$drop = array();
							foreach($query_airline as $airline):
								$drop[$airline->airline_code] = strtoupper($airline->airline_code);
							endforeach;
							echo form_dropdown('airline',$drop, 'ga', 'class = "span12"');
						?>
                      </div>
                      
                       <div class="span2">
                        <label>Agent</label>
                       <?php 
							$drop = array();
							foreach($query_agent as $agent):
								$drop[$agent->agent_id] = strtoupper($agent->agent_name);
							endforeach;
							echo form_dropdown('agent',$drop, '1', 'class = "span12"');
						?>
                      </div>
                
				</div>
                
                <div class="row-fluid">
                  
                      <div class="span2">
                        <label>From</label>
                       <?php 
							$drop = array();
							foreach($query_station as $station):
								$drop[$station->station_code] = strtoupper($station->station_code);
							endforeach;
							echo form_dropdown('from',$drop, 'kno', 'class = "span12"');
						?>
                      </div>
                      
                      <div class="span2">
                        <label>To</label>
                        <?php 
							$drop = array();
							foreach($query_station as $station):
								$drop[$station->station_code] = strtoupper($station->station_code);
							endforeach;
							echo form_dropdown('to',$drop, 'cgk', 'class = "span12"');
						?>
                      </div>
                      
                      <div class="span2">
                        <label>Final Dest ( multi leg )</label>
                        <?php 
							$drop = array();
							$drop['non'] = 'NON TRANSIT';
							foreach($query_station as $station):
								$drop[$station->station_code] = strtoupper($station->station_code);
							endforeach;
							echo form_dropdown('final_dest',$drop, 'non', 'class = "span12"');
						?>
                      </div>
                      
                     
                
				</div>
                
                
                <div class="row-fluid">
                      <div class="span4">
                      </div>
                      
                      <div class="span2">
                      <label></label>
                      <button class="btn btn-primary" type="submit">Next   ></button>
                      </div>
                      
                
				</div>
                
               
                
                <?php echo form_close(); ?>
                
                </p>
               
                
               
                </div>
            </div>
        </div>
        
	</div>
</div>