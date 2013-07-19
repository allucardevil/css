<div id='content'>
<script type="text/javascript">
function hitungtotal(value) {
  var dis=Number(value/100)*(Number (document.getElementById('overtime1').value));
  var hasil = Number (document.getElementById('overtime1').value)
	+ Number (document.getElementById('administrasi').value)-dis;
	var x=Number (document.getElementById('pp').value/100)*hasil;
	var ll=hasil+x;
	
	document.getElementById('disc_rp').value=dis.toFixed(2);
	document.getElementById('ppn_rp').value=x.toFixed(2);	
	//document.getElementById('overtime1').value=Math.round(hasil);
	document.getElementById('total_bayar').value=ll.toFixed(2);	
	document.getElementById('ppn1').value=x.toFixed(2);		
	}
</script>

            	<h2>Payment Receive BTB</h2>
				<table>
                    <?php 
					//print_r($weighing_details);
					echo form_open('cashier/payment/save_payment'); 
					foreach ($weighing_details as $row_wd){
					echo form_hidden('day', $selisih);
					?>
					<tr>
						<td>Date</td>
						<td><input name="date" class="span12" placeholder="ALL" type="text" value="<?php echo date('d-m-Y'); ?>" ></td>
						<td></td>
						<td>BTB No</td>
						<td><input name="btb_no" class="span12" placeholder="ALL" type="text" value="<?php echo $row_wd->wo_no; ?>" readonly></td>
					</tr>
					<tr>
						<td>Pengirim/Agent</td>
						<td><?php
							foreach ($agent as $row_agent ){
									$list_agent[$row_agent->agent_id]=strtoupper($row_agent->agent_name);
							}
							echo form_dropdown('agent',$list_agent,$row_wd->wo_agent);
						?></td>
						<td></td>
						<td>Airline / Asal</td>
						<td><input name="airline" size="5" placeholder="ALL" type="text" value="<?php echo strtoupper($row_wd->wo_airline); ?>" readonly> / <input name="airline" size="5" placeholder="ALL" type="text" value="<?php echo strtoupper($row_wd->wo_origin); ?>" readonly></td>
					</tr>
					<tr>
						<td>Administrasi</td>
						<td><input name="administrasi" class="span12" placeholder="" type="text" value="<?php echo $administration;?>"></td>
					</tr>
					<tr>
						<td>Sewa Gudang/Hari</td>
						<td><input name="sewa_gudang" class="span12" placeholder="ALL" type="text" value="<?php echo $daily_rates;?>"></td>
					</tr>
					<tr>
						<td>Total Sewa Gudang</td>
						<td><input name="sewa_gudang" class="span12" placeholder="ALL" type="text" value="<?php echo $total_sewa_gudang;?>"></td>
					</tr>
					<tr>
						<td>Disc. (% | Rp)</td>
						<td><input name="discount" size="5" onchange='javascript:hitungtotal(this.value)' type="text" ><input type="text" name="disc_rp" id="disc_rp" size="20" readonly></td>
					</tr>
					<tr>
						<td>PPn (%)</td>
						<td><input name="ppn" size="5" onchange='javascript:hitungtotal(this.value)' type="text" ><input type="text" name="ppn_rp" id="ppn_rp" size="20" readonly></td>
					</tr>
					<tr>
						<td>Biaya Total (Rp)</td>
						<td><input name="total_bayar" class="span12" placeholder="ALL" type="text" value="<?php echo $total_biaya;?>"></td>
					</tr>
					<tr>
						<td>BTB No</td>
						<td><input name="btb_no" class="span12" placeholder="ALL" type="text" value="<?php echo $row_wd->wo_no; ?>" readonly></td>
					</tr></tr>
						<td>BTB Type</td>
						<td><input name="btb_type" class="span12" placeholder="ALL" type="text" value="<?php echo strtoupper($type); ?>" readonly></td>
					</tr>
					<tr>
						<td>Consignee Name</td>
						<td><input name="consignee_name" class="span12" placeholder="ALL" type="text" value="<?php echo $row_wd->wod_consignee_address; ?>" readonly></td> </tr>
						<td>Consignee Address</td>
						<td><input name="consignee_address" class="span12" placeholder="ALL" type="text" value="<?php echo $row_wd->wod_consignee_address; ?>" readonly></td> </tr>
						<td>Administrasi (Rp)</td>
						<td></tr>
						<td>Total Sewa Gudang (Rp)</td>
						<td></tr>
						<td>PPn (%) </td>
						<td class="span1"><input name="ppn" class="span12" placeholder="ALL" type="text" value="<?php echo $tax;?>"></tr>
						<td>AWB No</td>
						<td><input name="awb_no" class="span12" placeholder="-" type="text" value="<?php echo $row_wd->wod_awb; ?>" readonly></td></tr>
						</tr>
						<td>Total Bayar</td>
						<td><input name="total_bayar" class="span12" placeholder="ALL" type="text" value="<?php echo $total_biaya;?>"></td></tr>
						<td>Payment Type</td>
						<td><?php
							foreach ($payment_type as $row_pt ){
									$pt[$row_pt->payment_type_name]=strtoupper($row_pt->payment_type_name);
							}
							echo form_dropdown('payment_type',$pt);
						?>
						</td>
					</td>	
                    <td class="row-fluid">
						<td>Date</td>
						<td></td>
					</td>	
                    <td class="row-fluid">
						<td>Agent</td>
						<td>
					</td>
					</td>	<td class="row-fluid">
						<td>Disc (%|Rp)</td>
						<td class="span1">
						<td>Ket. Disc</td>
						<td><textarea name="ket_disc" class="span12" ></textarea></td>
					</td>	
					
					
					<!-- hidden  value-->
                    <td class="row-fluid">
						<td></td>
						<td>
							<input type="hidden" name="actual_weight" value="<?php echo $actual_weight;?>">
							<input type="hidden" name="paid_weight" value="<?php echo $paid_weight;?>">
							<input type="hidden" name="charge" value="<?php echo $charge;?>">
						</td>
					</td>	
					<!-- hidden -->
					
					<td class="row-fluid">
                    	<td></td>
						<td><?php echo form_submit('submit', 'SAVE' , 'class="btn btn-primary"'); ?></td>
                    </td>
				</table>
					<?php 
					}
					
					?>
					
        </div>
