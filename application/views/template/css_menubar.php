<div id='menu'>
<table>
	<tr>
		<td><a href=?module=home>&#187; Home</a></td>
		<td><?php echo anchor('cashier/payment','New Payment Receipt'); ?></td>
		<td><?php echo anchor('cashier/payment/daily_outgoing_payment_report/'.date('d-m-Y', time()).'/'.date('d-m-Y', time()),'Daily Outgoing Payment Report'); ?></td>
		<td><?php echo anchor('cashier/payment/daily_incoming_payment_report/'.date('d-m-Y', time()).'/'.date('d-m-Y', time()),'Daily Incoming Payment Report'); ?></td>
		<td><?php echo anchor('incoming/add','My Payment Report'); ?></td>
		<td><?php echo anchor('incoming/add','No Faktur Pajak'); ?></td>
		<td><a href=logout.php>&#187; Logout</a></td>
	</tr>
</table>
</div>
