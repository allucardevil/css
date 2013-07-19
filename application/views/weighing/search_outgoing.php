<div class="container-fluid">
	<div class="row-fluid">
    
    	<div class="row-fluid">
        	<div class="block">
            	<a href="#page-stats" class="block-heading" data-toggle="collapse">SEARCH BTB</a>
        		<div id="page-stats" class="block-body collapse in">
                
                
                	<p>
                    
                    <?php echo form_open('weighing/outgoing/do_search'); ?>
                    
                    <div class="row-fluid">
                      <div class="span2">BTB No</div>
                      <div class="span4"><input name="btb_no" class="span12" placeholder="ALL" type="text"></div>
                    </div> 
                    <div class="row-fluid">
                      <div class="span2">Jenis BTB</div>
                      <div class="span4">
                      <?php
						  $options = array(
							  'outgoing'    => 'Outgoing',
							  'incoming'   	=> 'Incoming',
							);
						  echo form_dropdown('type', $options, 'outgoing', 'class = "span12"');
					  ?>
                      </div>
                    </div> 
                    
                	<div class="row-fluid">
                      <div class="span2">Start Date</div>
                      <div class="span4"><input name="start_date" class="span12" placeholder="select date" type="text" id="datepicker"></div>
                    </div> 
                    
                    <div class="row-fluid">
                      <div class="span2">End Date</div>
                      <div class="span4"><input name="end_date" class="span12" placeholder="select date" type="text" id="datepicker2"></div>
                    </div>  
                    
                    <div class="row-fluid">
                      <div class="span2">Origin</div>
                      <div class="span4">
					  <?php 
							$drop = array();
							$drop['all'] = 'ALL';
							foreach($query_station as $station):
								$drop[$station->station_code] = strtoupper($station->station_code);
							endforeach;
							echo form_dropdown('from',$drop, 'kno', 'class = "span12"');
						?>
                       </div>
                    </div>
                    
                    <div class="row-fluid">
                      <div class="span2">Destination</div>
                      <div class="span4">
                      <?php 
							$drop = array();
							$drop['all'] = 'ALL';
							foreach($query_station as $station):
								$drop[$station->station_code] = strtoupper($station->station_code);
							endforeach;
							echo form_dropdown('to',$drop, 'all', 'class = "span12"');
						?>
                      </div>
                    </div>
                    
                    <div class="row-fluid">
                      <div class="span2">Final Dest</div>
                      <div class="span4">
                      <?php 
							$drop = array();
							$drop['all'] = 'ALL';
							$drop['non'] = 'NON TRANSIT';
							foreach($query_station as $station):
								$drop[$station->station_code] = strtoupper($station->station_code);
							endforeach;
							echo form_dropdown('final_dest',$drop, 'non', 'class = "span12"');
						?>
                      </div>
                    </div>  
                    
                    <div class="row-fluid">
                      <div class="span2">Airline</div>
                      <div class="span4">
                      <?php 
							$drop = array();
							$drop['all'] = 'ALL';
							foreach($query_airline as $airline):
								$drop[$airline->airline_code] = strtoupper($airline->airline_code);
							endforeach;
							echo form_dropdown('airline',$drop, 'all', 'class = "span12"');
						?>
                      </div>
                    </div> 
                    
                    <div class="row-fluid">
                      <div class="span2">Agent</div>
                      <div class="span4">
                      <?php 
							$drop = array();
							$drop['all'] = 'ALL';
							foreach($query_agent as $agent):
								$drop[$agent->agent_id] = strtoupper($agent->agent_name);
							endforeach;
							echo form_dropdown('agent',$drop, 'all', 'class = "span12"');
						?>
                      </div>
                    </div> 
                    
                    <div class="row-fluid">
                      <div class="span2">Komoditi</div>
                      <div class="span4">
                      <?php 
							$drop = array();
							$drop['all'] = 'ALL';
							foreach($query_commodity as $commodity):
								$drop[$commodity->commodity_id] = strtoupper($commodity->commodity_code);
							endforeach;
							echo form_dropdown('commodity',$drop, 'all', 'class = "span12"');
						?>
                      </div>
                    </div>  
                    
                    <div class="row-fluid">
                      <div class="span2">Jenis Barang</div>
                      <div class="span4">
                      <?php 
							$drop = array();
							$drop['all'] = 'ALL';
							foreach($query_goods as $goods):
								$drop[$goods->goods_id] = strtoupper($goods->goods_name);
							endforeach;
							echo form_dropdown('goods',$drop, 'all', 'class = "span12"');
						?>
                      </div>
                    </div>  
                    
                    <div class="row-fluid">
                      <div class="span2">Payment Status</div>
                      <div class="span4">
                      <?php
						  $options = array(
							  'all'  		=> 'ALL',
							  'paid'    	=> 'PAID',
							  'unpaid'   	=> 'UNPAID',
							);
						  echo form_dropdown('payment', $options, 'all', 'class = "span12"');
					  ?>
                      </div>
                    </div>      
                    
                    <div class="row-fluid">
                      <div class="span2"></div>
                      <div class="span4"><button class="btn btn-primary btn-large" type="submit">SEARCH</button></div>
                    </div>
                    
                    <?php echo form_close(); ?>
                      
           			</p>
                
			
                
				
                
                
               
               
               
                </div>
            </div>
        </div>
        
	</div>
</div>