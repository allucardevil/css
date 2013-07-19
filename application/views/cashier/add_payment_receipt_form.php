<div class="container-fluid">
	<div class="row-fluid">
    
    	<div class="row-fluid">
        	<div class="block">
            	<a href="#page-stats" class="block-heading" data-toggle="collapse">SEARCH BTB</a>
        		<div id="page-stats" class="block-body collapse in">
					<?php if($this->uri->segment(4) == 'not_found')
					{ ?>
						<div class="row-fluid">
						<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">?</button>
							<strong>Note:</strong> <br/>
							Nomor yang dimasukkan salah.
						</div>
						</div>

					<?php }?>
                
                	<p>
                    
                    <?php 
							echo form_open('cashier/payment/do_search_receipt');
					?>
                    
                    <div class="row-fluid">
                      <div class="span2">BTB No</div>
                      <div class="span4"><input name="btb_no" class="span12" placeholder="EX : 11072013000001" type="text"></div>
                      <div class="span2"></div>

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
                    	<div class="span2"><?php echo form_submit('submit', 'search' , 'class="btn btn-primary"'); ?></div>
                    </div>
				</p>
                
                </div>
           </div>
        </div>