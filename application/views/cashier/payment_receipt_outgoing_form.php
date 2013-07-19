<div class="container-fluid">
	<div class="row-fluid">
    
    	
		
		<div class="row-fluid">
        	<div class="block">
            	<a href="#page-stats" class="block-heading" data-toggle="collapse">Payment Receive BTB</a>
        		<div id="page-stats" class="block-body collapse in">
                	<p>
                    
                    <?php echo form_open('cashier/payment/save_payment'); 
					foreach ($weighing_details as $row_wd){
					?>
					<div class="row-fluid">
						<div class="span2">Station</div>
						<div class="span4"><input name="station" class="span12" placeholder="ALL" type="text" value="<?php echo strtoupper($row_wd->wo_stn); ?>" readonly></div>
                    </div>
					<div class="row-fluid">
						<div class="span2">BTB No</div>
						<div class="span4"><input name="btb_no" class="span12" placeholder="ALL" type="text" value="<?php echo $row_wd->wod_wo_no; ?>" readonly></div>
                    </div>
					<div class="row-fluid">
						<div class="span2">BTB Type</div>
						<div class="span4"><input name="btb_type" class="span12" placeholder="ALL" type="text" value="<?php echo strtoupper($type); ?>" readonly></div>
                    </div>
					<div class="row-fluid">
						<div class="span2">Consignee Name</div>
						<div class="span4"><input name="consignee_name" class="span12" placeholder="ALL" type="text" value="<?php echo $row_wd->wod_consignee_address; ?>" readonly> </div>
					</div>
					<div class="row-fluid">
						<div class="span2">Consignee Address</div>
						<div class="span4"><input name="consignee_address" class="span12" placeholder="ALL" type="text" value="<?php echo $row_wd->wod_consignee_address; ?>" readonly> </div>
					</div>
					<div class="row-fluid">
						<div class="span2">Administrasi (Rp)</div>
						<div class="span4"><input name="administrasi" class="span12" placeholder="" type="text" value="<?php echo $administration;?>"></div>
					</div>
					<div class="row-fluid">
						<div class="span2">Total Sewa Gudang (Rp)</div>
						<div class="span4"><input name="sewa_gudang" class="span12" placeholder="ALL" type="text" value="<?php echo $total_sewa_gudang;?>"></div>
					</div>
					<div class="row-fluid">
						<div class="span2">PPn (%) </div>
						<div class="span1"><input name="ppn" class="span12" placeholder="ALL" type="text" value="<?php echo $tax;?>"></div>
					</div>	
					<div class="row-fluid">
						<div class="span2">AWB No</div>
						<div class="span4"><input name="awb_no" class="span12" placeholder="-" type="text" value="<?php echo $row_wd->wod_awb; ?>" readonly></div>
					</div>	
					<div class="row-fluid">
						<div class="span2">Airline / Asal</div>
						<div class="span1"><input name="airline" class="span12" placeholder="ALL" type="text" value="<?php echo strtoupper($row_wd->wo_airline); ?>" readonly></div>
						<div class="span2"><input name="airline" class="span12" placeholder="ALL" type="text" value="<?php echo strtoupper($row_wd->wo_origin); ?>" readonly></div>
					</div>	
					<div class="row-fluid">
						<div class="span2">Total Bayar</div>
						<div class="span4"><input name="total_bayar" class="span12" placeholder="ALL" type="text" value="<?php echo $total_biaya;?>"></div>
					</div>	
                    <div class="row-fluid">
						<div class="span2">Payment Type</div>
						<div class="span4"><?php
							foreach ($payment_type as $row_pt ){
									$pt[$row_pt->payment_type_name]=strtoupper($row_pt->payment_type_name);
							}
							echo form_dropdown('payment_type',$pt);
						?>
						</div>
					</div>	
                    <div class="row-fluid">
						<div class="span2">Date</div>
						<div class="span4"><input name="date" class="span12" placeholder="ALL" type="text" value="<?php echo date('d-m-Y'); ?>" ></div>
					</div>	
                    <div class="row-fluid">
						<div class="span2">Agent</div>
						<div class="span4"><?php
							foreach ($agent as $row_agent ){
									$list_agent[$row_agent->agent_id]=strtoupper($row_agent->agent_name);
							}
							echo form_dropdown('agent',$list_agent,$row_wd->wo_agent);
						?>
					</div>
					</div>	<div class="row-fluid">
						<div class="span2">Disc (%|Rp)</div>
						<div class="span1"><input name="discount" class="span12" placeholder="" type="text" ></div>
						<div class="span2"><input type="text" name="disc_rp" id="disc_rp" style="width:63%"></div>
					</div>
					<div class="row-fluid">
						<div class="span2">Ket. Disc</div>
						<div class="span4"><textarea name="ket_disc" class="span12" ></textarea></div>
					</div>	
					
					
					<!-- hidden  value-->
                    <div class="row-fluid">
						<div class="span2"></div>
						<div class="span4">
							<input type="hidden" name="actual_weight" value="<?php echo $actual_weight;?>">
							<input type="hidden" name="paid_weight" value="<?php echo $paid_weight;?>">
							<input type="hidden" name="charge" value="<?php echo $charge;?>">
						</div>
					</div>	
					<!-- hidden -->
					
					<div class="row-fluid">
                    	<div class="span2"></div>
						<div class="span4"><?php echo form_submit('submit', 'SAVE' , 'class="btn btn-primary"'); ?></div>
                    </div>
				
					<?php 
					}
					
					?>
					
				</p>
                </div>
				
           </div>
        </div>
