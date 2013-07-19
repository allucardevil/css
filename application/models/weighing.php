<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Weighing extends CI_Model {

	/**
	 * PT Gapura Angkasa
	 * Warehouse Management System.
	 * ver 3.0
	 * 
	 * App id :
	 * App code :
	 *
	 * weighing model
	 *
	 * url : http://dom.kno.wms.gapura.co.id/
	 * design : SIGAP Team
	 * project head : mantara@gapura.co.id
	 *
	 * developer : pandhawa digital
	 * phone : 0361 853 2400
	 * email : pandhawa.digital@gmail.com
	 */
	 
	 # outgoing data -----------------------------------
	 
	 public function total_data_outgoing_today()
	 {
		 $this->db->where('wo_date', mdate("%Y-%m-%d", time()));
		 $this->db->from('weighing_outgoing');
		 $query = $this->db->count_all_results();
		 return $query;
	 }
	 
	 public function list_data_outgoing_today($limit, $offset)
	 {
		 $this->db->where('wo_date', mdate("%Y-%m-%d", time()));
		 $this->db->join('var_agent', 'var_agent.agent_id = weighing_outgoing.wo_agent');
		 $this->db->from('weighing_outgoing');
		 $this->db->limit($limit, $offset);
		 $query = $this->db->get();
		 return $query->result();
	 }
	 
	 public function get_outgoing_data_by_id($wo_no)
	 {
		 $this->db->where('wo_no', $wo_no); 
		 $this->db->join('var_agent', 'var_agent.agent_id = weighing_outgoing.wo_agent');
		 $query = $this->db->get('weighing_outgoing');
		 return $query->result();
	 }
	 
	 public function save_data_outgoing($date, $stn, $wo_no, $airline, $agent, $from, $to, $final_dest, $user)
	 {
		 $data = array(
		 'wo_date' => $date, 
		 'wo_stn' => $stn, 
		 'wo_no' => $wo_no, 
		 'wo_airline' => $airline, 
		 'wo_agent' => $agent, 
		 'wo_origin' => $from, 
		 'wo_destination' => $to, 
		 'wo_final_dest' => $final_dest, 
		 'wo_update_by' => $user
		 );
		 
		 $this->db->insert('weighing_outgoing', $data); 
	 }
	 
	 public function delete_data_outgoing_by_id($wo_no)
	 {
		 $this->db->where('wo_no', $wo_no);
		 $this->db->update('weighing_outgoing', array('wo_status' => 'void')); 
	 }
	 # outgoing data -----------------------------------
	 
	 
	 # outgoing weight ---------------------------------
	 
	 public function save_weight($stn, $wo_no, $goods, $pcs, $weight, $length, $width, $height, $vol_weight, $paid_weight, $user)
	 {
		 $data = array(
		 'wow_stn' 				=> $stn,
		 'wow_wo_no' 			=> $wo_no,
		 'wow_goods_id' 		=> $goods, 
		 'wow_piece' 			=> $pcs, 
		 'wow_actual_weight' 	=> $weight, 
		 'wow_length' 			=> $length, 
		 'wow_width' 			=> $width, 
		 'wow_height' 			=> $height, 
		 'wow_vol_weight'		=> $vol_weight, 
		 'wow_paid_weight' 		=> $paid_weight, 
		 'wow_update_by' 		=> $user,
		 );
		 
		 $this->db->insert('weighing_outgoing_weight', $data);
	 }
	 
	 public function get_outgoing_weight_by_id($wo_no)
	 {
		 $this->db->where('wow_wo_no', $wo_no);
		 $this->db->join('var_goods', 'var_goods.goods_id = weighing_outgoing_weight.wow_goods_id');
		 $this->db->join('var_commodity', 'var_commodity.commodity_id = var_goods.goods_commodity_id'); 
		 $this->db->order_by('wow_id', 'asc'); 
		 $query = $this->db->get('weighing_outgoing_weight');
		 return $query->result();
	 }
	 
	 public function delete_data_weight_by_id($wow_id)
	 {
		 $this->db->where('wow_id', $wow_id);
		 $this->db->update('weighing_outgoing_weight', array('wow_display' => 'n')); 
	 }
	 	
	 # outgoing weight ---------------------------------
	 
	 
	 
	 # outgoing details --------------------------------
	 
	 public function get_outgoing_details_by_id($wo_no)
	 {
		 $this->db->where('wod_wo_no', $wo_no);
		 $query = $this->db->get('weighing_outgoing_details');
		 return $query->result();
	 }
	 
	 public function save_outgoing_details($stn, $wo_no, $user)
	 {
		 $data = array(
		   'wod_wo_no' => $wo_no,
		   'wod_stn' => $stn,
		   'wod_update_by' => $user,
		);

		$this->db->insert('weighing_outgoing_details', $data); 
	 }
	 public function update_outgoing_details($data,$wo_no)
	 {
		$this->db->where('wod_wo_no',$wo_no);
		$this->db->update('weighing_outgoing_details', $data);
		
	 }
	 # outgoing details --------------------------------
	 
	 
	 
	 # public -------------------------------------------
	 
	 public function get_last_wor($wor_type)
	 {
		#$this->db->select_max('wo_id');
		$query = $this->db->get('weighing_outgoing');
		
		# prepare value
		$wor_date = mdate("%d%m%Y", time());
		$wo_start = $this->config->item('wo_start');
		
		if($query -> num_rows() == 0)
   		{
			# handling empty record
			$query = $wor_date . $wor_type . $wo_start;
			return $query;
		}
		else
		{
			# handling not empty record
			foreach($query->result() as $item):
				$query = $item->wo_no;
			endforeach;
			
			# handling same date
			if(substr($query, 0, 8) == mdate("%d%m%Y", time()))
			{
				$date_serial = substr($query, 0, 8);
				$serial_number = substr($query, 9) + 1;
				$serial_number =  sprintf("%1$05d", $serial_number);
				$query = $date_serial . $wor_type . $serial_number;
			}
			else # handling different date / restart new serial number
			{
				$query = $wor_date . $wor_type . $wo_start;	
			}
			return $query;
		}
	 }
	 
	 # public -------------------------------------------
	 
	 
	 # search -------------------------------------------
	 
	 public function total_outgoing_search($btb_no, $type, $start_date, $end_date, $from, $to, $final_dest, $airline, $agent, $commodity, $goods, $payment)
	{
     		# selecting better query approach
			if ($btb_no == 'all'){$weight_query = ''; $btb_no_query = '';}else{$weight_query = "WHERE wow_wo_no LIKE '%" . $btb_no . "%'";$btb_no_query = "AND wow_wo_no LIKE '%" . $btb_no . "%'";}
			if ($goods == 'all') { $goods_query = '';}else{$goods_query = "WHERE wow_goods_id ='" . $goods . "'";}
			if ($from == 'all') { $from_query = '';}else{$from_query = "AND wo_origin ='" . $from . "'";}
			if ($to == 'all') { $to_query = '';}else{$to_query = "AND wo_destination ='" . $to . "'";}
			if ($airline == 'all') { $airline_query = '';}else{$airline_query = "AND wo_airline ='" . $airline . "'";}
			if ($agent == 'all') { $var_agent_query = '';$agent_query = '';}else{$var_agent_query = "WHERE agent_id ='" . $agent . "'";$agent_query = "AND wo_agent ='" .$agent . "'";}
			if ($commodity == 'all') { $commodity_query = '';}else{$commodity_query = "WHERE commodity_code ='" .$commodity . "'";}
			if ($payment == 'all') { $payment_query = '';}else{$payment_query = "AND wo_status ='" .$payment . "'";}
			if ($final_dest == 'non') { $final_dest_query = '';}else{$final_dest_query = "AND wo_final_dest ='" .$final_dest . "'";}
			
		
		 $query=("
		   SELECT wo_no, COUNT(distinct wo_no) as total FROM weighing_outgoing as weighing 
	
		   	  LEFT OUTER JOIN ( 
			  SELECT * FROM weighing_outgoing_weight   
			  " . $weight_query .") as weight On weight.wow_wo_no = weighing.wo_no
			  
			  LEFT OUTER JOIN ( 
			  SELECT * FROM var_goods   
			  " . $goods_query . ") as goods On goods.goods_id = weight.wow_goods_id
			  
			  LEFT OUTER JOIN ( 
			  SELECT * FROM var_commodity   
			  " . $commodity_query . ") as commodity On commodity.commodity_id = goods.goods_commodity_id
			  
			  LEFT OUTER JOIN ( 
			  SELECT * FROM var_agent   
			  " . $var_agent_query . " ) as agent On agent.agent_id = weighing.wo_agent
			   
			  WHERE wo_stn = 'kno'
			  AND ( wo_date BETWEEN '" . $start_date . "' AND '" . $end_date . "' )
			  " . $btb_no_query . "
			  " . $airline_query . "
			  " . $from_query . "
			  " . $to_query . "
			  " . $final_dest_query . "
			  " . $agent_query . "
			  " . $payment_query . "
     		");
    
     $query = $this->db->query($query);
     return $query->result();
     $query->free_result();
    }
	 
	 
	 public function list_outgoing_search($btb_no, $type, $start_date, $end_date, $from, $to, $final_dest, $airline, $agent, $commodity, $goods, $payment, $limit 	, $offset)
	 {
			
			if ($btb_no == 'all'){$weight_query = ''; $btb_no_query = '';}else{$weight_query = "WHERE wow_wo_no LIKE '%" . $btb_no . "%'";$btb_no_query = "AND wow_wo_no LIKE '%" . $btb_no . "%'";}
			if ($goods == 'all') { $goods_query = '';}else{$goods_query = "WHERE wow_goods_id ='" . $goods . "'";}
			if ($from == 'all') { $from_query = '';}else{$from_query = "AND wo_origin ='" . $from . "'";}
			if ($to == 'all') { $to_query = '';}else{$to_query = "AND wo_destination ='" . $to . "'";}
			if ($airline == 'all') { $airline_query = '';}else{$airline_query = "AND wo_airline ='" . $airline . "'";}
			if ($agent == 'all') { $var_agent_query = '';$agent_query = '';}else{$var_agent_query = "WHERE agent_id ='" . $agent . "'";$agent_query = "AND wo_agent ='" .$agent . "'";}
			if ($commodity == 'all') { $commodity_query = '';}else{$commodity_query = "WHERE commodity_code ='" .$commodity . "'";}
			if ($payment == 'all') { $payment_query = '';}else{$payment_query = "AND wo_status ='" .$payment . "'";}
			if ($final_dest == 'non') { $final_dest_query = '';}else{$final_dest_query = "AND wo_final_dest ='" .$final_dest . "'";}
			
			
			$query=("
			  SELECT * FROM weighing_outgoing as weighing 
		
			  LEFT OUTER JOIN ( 
			  SELECT * FROM weighing_outgoing_weight   
			  " . $weight_query .") as weight On weight.wow_wo_no = weighing.wo_no
			  
			  LEFT OUTER JOIN ( 
			  SELECT * FROM var_goods   
			  " . $goods_query . ") as goods On goods.goods_id = weight.wow_goods_id
			  
			  LEFT OUTER JOIN ( 
			  SELECT * FROM var_commodity   
			  " . $commodity_query . ") as commodity On commodity.commodity_id = goods.goods_commodity_id
			  
			  LEFT OUTER JOIN ( 
			  SELECT * FROM var_agent   
			  " . $var_agent_query . " ) as agent On agent.agent_id = weighing.wo_agent
			   
			  WHERE wo_stn = 'kno'
			  AND ( wo_date BETWEEN '" . $start_date . "' AND '" . $end_date . "' )
			  " . $btb_no_query . "
			  " . $airline_query . "
			  " . $from_query . "
			  " . $to_query . "
			  " . $final_dest_query . "
			  " . $agent_query . "
			  " . $payment_query . "
			  
			  GROUP BY wo_no
			  LIMIT " . $limit . "
			  OFFSET " . $offset . "
			  
			 ");
 
     $query = $this->db->query($query);
     return $query->result();
     $query->free_result();
	 }
	 
	 # search -------------------------------------------
	 
	 
	 


/* End of file weighing.php */
/* Location: ./application/models/weighing.php */

/*start of file incoming */

	public function get_last_wir($wir_type)
	 {
		#$this->db->select_max('wo_id');
		$query = $this->db->get('weighing_incoming');
		
		# prepare value
		$wir_date = mdate("%d%m%Y", time());
		$wi_start = $this->config->item('wi_start');
		
		if($query -> num_rows() == 0)
   		{
			# handling empty record
			$query = $wir_date . $wir_type . $wi_start;
			return $query;
		}
		else
		{
			# handling not empty record
			foreach($query->result() as $item):
				$query = $item->wi_no;
			endforeach;
			
			# handling same date
			if(substr($query, 0, 8) == mdate("%d%m%Y", time()))
			{
				$date_serial = substr($query, 0, 8);
				$serial_number = substr($query, 9) + 1;
				$serial_number =  sprintf("%1$05d", $serial_number);
				$query = $date_serial . $wir_type . $serial_number;
			}
			else # handling different date / restart new serial number
			{
				$query = $wir_date . $wir_type . $wi_start;	
			}
			return $query;
		}
	 }
	 
	 public function save_incoming($date, $stn, $awb_no, $wi_no, $airline, $agent, $from, $to, $final_dest, $user)
	 {
		 $data = array(
		 'wi_date' => $date, 
		 'wi_stn' => $stn, 
		 'wi_awb_no' => $wi_awb_no, 
		 'wi_no' => $wi_no, 
		 'wi_airline' => $airline, 
		 'wi_agent' => $agent, 
		 'wi_origin' => $from, 
		 'wi_destination' => $to, 
		 'wi_final_dest' => $final_dest, 
		 'wi_update_by' => $user
		 );
		 
		 $this->db->insert('weighing_incoming', $data); 
	 }
     
	 public function get_weighing_incoming_data_by_id($wi)
	 {
		 $this->db->where('wi_no', $wi); 
		 $query = $this->db->get('weighing_incoming');
		 return $query->result();
	 }
	 
	 public function get_weighing_incoming_weight_by_id($wi)
	 {
		 /*
		 $this->db->where('wiw_wi_no', $wi); 
		 $query = $this->db->get('weighing_incoming_weight');
		 return $query->result();
		 */
		 $this->db->where('wiw_wi_no', $wi);
		 $this->db->join('var_goods', 'var_goods.goods_id = weighing_incoming_weight.wiw_goods_id');
		 $this->db->join('var_commodity', 'var_commodity.commodity_id = var_goods.goods_commodity_id'); 
		 $this->db->order_by('wiw_id', 'asc'); 
		 $query = $this->db->get('weighing_incoming_weight');
		 return $query->result();
	
	 }
	 
	 public function save_weight_incoming($stn, $wi_no, $goods, $pcs, $weight, $length, $width, $height, $vol_weight, $paid_weight, $user)
	 {
		 $data = array(
		 'wiw_stn' 				=> $stn,
		 'wiw_wi_no' 			=> $wi_no,
		 'wiw_goods_id' 		=> $goods, 
		 'wiw_piece' 			=> $pcs, 
		 'wiw_actual_weight' 	=> $weight, 
		 'wiw_length' 			=> $length, 
		 'wiw_width' 			=> $width, 
		 'wiw_height' 			=> $height, 
		 'wiw_vol_weight'		=> $vol_weight, 
		 'wiw_paid_weight' 		=> $paid_weight, 
		 'wiw_update_by' 		=> $user,
		 );
		 
		 $this->db->insert('weighing_incoming_weight', $data);
	 }
	 
	 #-------------------------------------------------------
	 
	 public function total_incoming_today()
	 {
		 $this->db->where('wi_date', mdate("%Y-%m-%d", time()));
		 $this->db->from('weighing_incoming');
		 $query = $this->db->count_all_results();
		 return $query;
	 }
	 
	 public function list_incoming_today($limit, $offset)
	 {
		 $this->db->where('wi_date', mdate("%Y-%m-%d", time()));
		 $this->db->from('weighing_incoming');
		 $this->db->limit($limit, $offset);
		 $query = $this->db->get();
		 return $query->result();
	 }
	 
	 public function update_awb_weighing_outgoing($wo_no,$data)
	 {
		$this->db->where('wod_wo_no', $wo_no);
		$this->db->update('weighing_outgoing_details', $data); 
	 } 
	 
	public function get_total_outgoing_weight($wo_no) 
	{	
		$query= "	SELECT  `wow_wo_no` , SUM(  `wow_actual_weight` ) AS total_actual_weight, SUM(  `wow_paid_weight` ) AS total_paid_weight, SUM(  `wow_piece` ) AS total_piece
					FROM weighing_outgoing_weight
					WHERE wow_display =  'y'
					AND wow_wo_no =  '$wo_no'
				";
		$query = $this->db->query($query);
		return $query->result();
	}	
	
	public function get_awb_weighing_outgoing($wo_no)
	{
		 $this->db->where('wod_wo_no', $wo_no);
		 $this->db->select('wod_awb');
		 $query = $this->db->get('weighing_outgoing_details');
		 return $query->result();
	}
	
}
	 