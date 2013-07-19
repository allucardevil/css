<div class="container-fluid">
	<div class="row-fluid">
    
    	<div class="row-fluid">
        	<div class="block">
            	<a href="#page-stats" class="block-heading" data-toggle="collapse">BUILD UP</a>
        		<div id="page-stats" class="block-body collapse in">
                
                <p>
                
                <?php echo form_open('outgoing/build_up/save_build_up'); ?> 
                
				<div class="row-fluid">
                
                    <div class="span2">
                        <label>Date</label>
                        <input name="date" class="span12" placeholder="select date" type="text" id="datepicker">
                    </div>
                    <div class="span2">
                        <label>ULD No</label>
                        <input name="uld" class="span12" placeholder="type uld no here...." type="text">
                    </div>
                    <div class="span2">
                        <label>Flight No</label>
                        <input name="flight_no" class="span12" placeholder="type flight no here...." type="text">
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