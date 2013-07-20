<div id='content'>
<script type="text/javascript">
function hitungtotal(value) {
  var dis=Number(value/100)*(Number (document.getElementById('day').value));
  var hasil = Number (document.getElementById('day').value)
	+ Number (document.getElementById('administrasi').value)-dis;
	var x=Number (document.getElementById('ppn').value/100)*hasil;
	var ll=hasil+x;
	
	document.getElementById('disc_rp').value=dis.toFixed(2);
	document.getElementById('ppn_rp').value=x.toFixed(2);	
	//document.getElementById('overtime1').value=Math.round(hasil);
	document.getElementById('total_bayar').value=ll.toFixed(2);			
	}
</script>
<script type="text/javascript">
function validateForm()
{
var x=document.forms["form1"]["btb_agent"].value
var y=document.forms["form1"]["airline"].value
if (x==null || x=="" || y==null || y=="")
  {
  alert("Agent atau airline tidak boleh kosong, silahkan edit data via aplikasi BTB");
  return false;
  }
}

</script>


            	<h2>Payment Receive BTB - Outgoing</h2>
				<table>
                    <?php 
					//print_r($weighing_details);
					echo form_open('cashier/payment/save_payment'); 
					foreach ($weighing_details as $row_wd){
					echo form_hidden('day', $selisih);
					echo form_hidden('btb_type',strtoupper($type));
					?>
					<tr>
						<td>Consignee Name</td>
						<td><input name="consignee_name" class="span12" placeholder="ALL" type="text" value="<?php echo $row_wd->wod_consignee_address; ?>" readonly></td> 
						<td></td>
						<td>Consignee Address</td>
						<td><input name="consignee_address" class="span12" placeholder="ALL" type="text" value="<?php echo $row_wd->wod_consignee_address; ?>" readonly></td> </tr>
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
						<td>AWB No</td>
						<td><input name="awb_no" class="span12" placeholder="-" type="text" value="<?php echo $row_wd->wod_awb; ?>" readonly></td>
					</tr>
					<tr>
						<td>Administrasi</td>
						<td><input name="administrasi" class="span12" placeholder="" type="text" value="<?php echo $administration;?>"></td>
						<td></td>
						<td>Airline / Asal</td>
						<td><input name="airline" size="5" placeholder="ALL" type="text" value="<?php echo strtoupper($row_wd->wo_airline); ?>" readonly> / <input name="airline" size="5" placeholder="ALL" type="text" value="<?php echo strtoupper($row_wd->wo_origin); ?>" readonly></td>
					</tr>
					<tr>
						<td>Sewa Gudang/Hari</td>
						<td><input name="sewa_gudang" class="span12" placeholder="ALL" type="text" value="<?php echo $daily_rates;?>"></td>
						<td></td>
						<td>Total Berat Bayar</td>
						<td><input name="berat_bayar" class="span12" placeholder="" type="text" value="<?php echo $paid_weight;?>"></td>
					</tr>
					<tr>
						<td>Total Sewa Gudang</td>
						<td><input name="sewa_gudang" class="span12" placeholder="ALL" type="text" value="<?php echo $total_sewa_gudang;?>"></td>
						<td></td>
						<td>Payment Type</td>
						<td><?php
							foreach ($payment_type as $row_pt ){
									$pt[$row_pt->payment_type_name]=strtoupper($row_pt->payment_type_name);
							}
							echo form_dropdown('payment_type',$pt);
						?>
						</td>
					</tr>
					<tr>
						<td>Disc. (% | Rp)</td>
						<td><input name="discount" size="5" onchange='javascript:hitungtotal(this.value)' type="text" ><input type="text" name="disc_rp" id="disc_rp" size="20" readonly></td>
						<td></td>
						<td colspan="2" rowspan="3">Keterangan Discount : <br/><textarea name="ket_disc" cols="40"></textarea></td>
					</tr>
					<tr>
						<td>PPn (%)</td>
						<td><input name="ppn" size="5" onchange='javascript:hitungtotal(this.value)' type="text" value="<?php echo $tax;?>"><input type="text" name="ppn_rp" id="ppn_rp" size="20" readonly></td>
						<td></td>
					</tr>
					<tr>
						<td>Biaya Total (Rp)</td>
						<td><input name="total_bayar" class="span12" placeholder="ALL" type="text" value="<?php echo $total_biaya;?>"></td>
						<td></td>
					</tr>
					<!-- hidden  value-->
							<input type="hidden" name="actual_weight" value="<?php echo $actual_weight;?>">
							<input type="hidden" name="paid_weight" value="<?php echo $paid_weight;?>">
							<input type="hidden" name="charge" value="<?php echo $charge;?>">
					<!-- hidden -->
					<tr>
						<td colspan="5"><?php echo form_submit('submit', 'SAVE' , 'class="btn btn-primary"'); ?></td>
					</tr>
				</table>
					<?php 
					}
					
					?>
					
        </div>
